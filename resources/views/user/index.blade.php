@extends('layouts.template')

@section('content')

   @if(Session::get('success'))
       <div class="alert alert-success"> {{ Session::get('success') }}</div>
   @endif  
    @if(Session::get('deleted'))
      <div class="alert alert-warning"> {{ Session::get('deleted') }}</div>
    @endif  
    
    <div class="d-flex d-flex justify-content-end align-items-center">
        <a href="{{ route('user.create') }}" class="btn btn-secondary mb-3 mt-4 d-flex justify-content-end">Tambah Akun</a>  
    </div>    

   <table class="table table-striped table-bordered table-hover">
       <thead>
            <tr>
                <th>NO</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th class="text-center">Aksi</th>
            <tr>  
        </thead> 
        <tbody> 
            @php $no = 1; @endphp
            @foreach ($users as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ ucwords($item['name']) }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td>{{ ucwords($item['role']) }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('user.edit', $item['id'])}}" class="btn btn-primary me-3">Edit</a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$item['id']}}">
                           Hapus
                          </button>  
                    </td>          
                </tr>
  <div class="modal fade" id="exampleModal-{{$item['id']}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Yakin ingin menghapus data ini?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           <form action="{{ route('user.delete', $item['id']) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
        </div>
      </div>
    </div>
  </div> 
  @endforeach
</tbody>
</table>  
  @endsection                