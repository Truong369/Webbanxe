<x-admin title="Giới thiệu">
    <div class="row">
        <div class="col-lg-6">
            <a href="{{ route('admin.about.add') }}" class="btn btn-success text-light btn-sm shadow">
                <i class="fas fa-plus"></i> Thêm mới
            </a>
            <a href="{{ route('admin.about') }}" class="btn btn-info text-light btn-sm shadow">
                <i class="fas fa-undo"></i> Làm mới
            </a>
        </div>
        <div class="col-lg-6 d-flex justify-content-end">
        </div>
        <div class="col-lg-12 mt-3">
            <table class="table shadow-sm">
                <thead class="bg-info text-light">
                    <tr>
                        <th>#</th>
                        <th>Tiêu đề</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($about as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{$item->title}}</td>
                            <td>
                                <a href="{{ route('admin.about.edit', $item->id) }}" class="btn btn-sm btn-warning shadow"><i class="fas fa-edit"></i></a>
                                <a href="{{ route('admin.about.delete', $item->id) }}"
                                    class="btn btn-sm btn-danger shadow"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin>
