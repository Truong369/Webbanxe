<template lang="">
    <div class="vueDataProduct">
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            {{ action }} sản phẩm
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">Tên sản phẩm</label>
                                    <input type="text" class="form-control" v-model="proData.name" />
                                </div>
                                <!-- <x-input name="{{proData.name}}" label="Tên sản phẩm" id="name"/> -->
                                <div class="form-group">
                                    <label class="form-label">Giá</label>
                                    <input type="number" class="form-control" v-model="proData.price" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Mô tả</label>
                                    <input type="text" class="form-control" v-model="proData.description" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Danh mục</label>
                                    <select v-model="proData.categoryId" class="form-select">
                                        <option v-for="item in categories" :value="item.id" :key="item.id">
                                            {{ item.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="" class="form-label">Hình ảnh</label>
                                    <input type="file" id="image" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Đóng
                        </button>
                        <button type="button" class="btn btn-primary" @click="addOrUpdate">
                            <i class="fas fa-save"></i> Lưu
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <button class="btn btn-success text-light btn-sm shadow" @click="showCreateModal">
                    <i class="fas fa-plus"></i> Thêm mới
                </button>
                <button class="btn btn-info text-light btn-sm shadow" @click="getProduct">
                    <i class="fas fa-undo"></i> Làm mới
                </button>
            </div>
        </div>
        <table class="table shadow mt-2">
            <thead class="bg-info text-light">
                <tr>
                    <th>#</th>
                    <th>Tên</th>
                    <th>Hình ảnh</th>
                    <th>Giá</th>
                    <th>Mô tả</th>
                    <th>Danh mục</th>
                    <th>Chức năng</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in products" :key="item.id">
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td>
                        <img :src="`/storage/images/${item.image}`" width="80" class="shadow-sm rounded" alt="" />
                    </td>
                    <td>{{ item.price }}</td>
                    <td>{{ item.description }}</td>
                    <td>{{ item.categoryId }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning shadow" @click="getDataForUpdate(item)">
                            Sửa
                        </button>
                        <button class="btn btn-sm btn-danger shadow" @click="deleteProduct(item.id)">
                            Xóa
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    let noti = new AWN({
        minDurations: {
            "async-block": 300,
            async: 300,
        },
    });
    export default {
        data() {
            return {
                products: [],
                categories: [],
                mCreate: {},
                action: "",
                proData: {
                    id: 0,
                    name: "",
                    price: "",
                    description: "",
                    categoryId: "",
                }
            };
        },
        methods: {
            showCreateModal() {
                this.clearData();
                this.action = "Thêm";
                this.mCreate.show();
            },
            getProduct() {
                noti.asyncBlock(
                    axios.get('/admin/products/list'),
                    (res) => {
                        this.products = res.data;
                    },
                    (err) => {
                        noti.alert(err);
                    },
                    "Đang tải"
                );
            },
            getCategory() {
                axios.get("/api/categories").then((res) => {
                    this.categories = res.data;
                });
            },
            clearData() {
                this.proData = {
                    id: 0,
                    name: null,
                    price: null,
                    description: null,
                    categoryId: null,
                };
            },
            addOrUpdate() {
                let url = "/api/products/store";
                let formData = new FormData();
                let file = document.getElementById("image").files[0];
                let config = {
                    headers: {
                        "content-type": "multipart/form-data"
                    }
                }

                formData.append("name", this.proData.name);
                formData.append("image", file);
                formData.append("price", this.proData.price);
                formData.append("description", this.proData.description);
                formData.append("categoryId", this.proData.categoryId);

                if (this.proData.id != 0) {
                    url = "/api/products/update/" + this.proData.id;
                }

                axios.post(url, formData, config)
                    .then((res) => {
                        noti.success(res.data.message);
                        this.mCreate.hide();
                        this.clearData();
                        this.getProduct();
                    })
                    .catch((err) => {
                        let errMes = err.response.data.errors;
                        for (let i in errMes) {
                            for (let j of errMes[i]) {
                                noti.alert(j);
                                return;
                            }
                        }
                    });
            },
            getDataForUpdate(pro) {
                this.proData.id = pro.id;
                this.proData.name = pro.name;
                this.proData.price = pro.price;
                this.proData.description = pro.description;
                this.proData.categoryId = pro.categoryId;
                this.action = "Cập nhật";
                this.mCreate.show();
            },
            deleteProduct(id) {
                axios
                    .delete("/api/products/delete/" + id)
                    .then((res) => {
                        noti.success(res.data.message);
                        this.getProduct();
                    })
                    .catch(() => {});
            },
        },
        mounted() {
            this.mCreate = new bootstrap.Modal("#exampleModal");
            this.getCategory();
            this.getProduct();
        },
    };

</script>
