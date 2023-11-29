<template lang="">
    <div class="vueDataCategory">
        <div class="row">
            <div class="col-lg-6">
                <label for="" class="form-label">Tên danh mục</label>
                <input type="text" class="form-control" v-model="cateData.name" placeholder="Nhập tên danh mục..." />
                <button class="btn btn-success text-light btn-sm shadow mt-2"
                    @click="isUpdate ? updateCategory() : addCategory()">
                    <i class="fas fa-plus"></i>
                    {{ isUpdate ? "Cập nhật" : "Thêm mới" }}
                </button>
                <button class="btn btn-dark text-light btn-sm shadow mt-2" v-if="isUpdate" @click="clearData">
                    <i class="fas fa-undo"></i> Trở lại
                </button>
            </div>
            <div class="col-lg-6 d-flex justify-content-end align-items-end">
                <button class="btn btn-info text-light btn-sm shadow" @click="getCategory">
                    <i class="fas fa-undo"></i> Làm mới
                </button>
            </div>
        </div>
        <table class="table shadow mt-2">
            <thead class="bg-info text-light">
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Tạo lúc</th>
                    <th class="text-end">Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in categories" :key="item.id">
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ new Date(item.created_at).toLocaleString() }}</td>
                    <td class="text-end">
                        <button class="btn btn-sm btn-warning shadow" @click="getDataForUpdate(item)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger shadow" @click="deleteCategory(item.id)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    let noti = new AWN({
        'minDurations': {
            'async': 300,
            'async-block': 300,
        }
    });
    export default {
        data() {
            return {
                categories: [],
                isUpdate: false,
                cateData: {
                    id: 0,
                    name: null,
                },
            };
        },
        methods: {
            getCategory() {
                noti.asyncBlock(
                    axios.get("/api/categories"),
                    (res) => {
                        this.categories = res.data;
                    },
                    (err) => {
                        noti.alert(err);
                    },
                    "Chờ đợi đến bao giờ"
                );
            },
            getDataForUpdate(cate) {
                this.isUpdate = true;
                this.cateData.id = cate.id;
                this.cateData.name = cate.name;
            },
            addCategory() {
                axios.post("/api/categories", this.cateData)
                    .then(res => {
                        this.clearData();
                        this.getCategory();
                        noti.success(res.data.message);
                    })
                    .catch(err => {
                        let errMes = err.response.data.errors;
                        for (let i in errMes) {
                            for (let j of errMes[i]) {
                                noti.alert(j);
                                return;
                            }
                        }
                    })
            },
            updateCategory() {
                noti.async(
                    axios.put("/api/categories/" + this.cateData.id, this.cateData),
                    () => {
                        this.clearData();
                        this.getCategory();
                    },
                    (err) => {
                        let errMes = err.response.data.errors;
                        for (let i in errMes) {
                            for (let j of errMes[i]) {
                                noti.alert(j);
                                return;
                            }
                        }
                    }
                );
            },
            deleteCategory(id) {
                axios.delete(`/api/categories/${id}`)
                    .then((res) => {
                        noti.success(res.data.message);
                        this.getCategory();
                    })
                    .catch(() => {
                        noti.alert('Xóa không thành công!')
                    })
            },
            clearData() {
                this.isUpdate = false;
                this.cateData = {
                    id: 0,
                    name: null,
                };
            },
        },
        mounted() {
            this.getCategory();
        },
    };

</script>
<style lang=""></style>
