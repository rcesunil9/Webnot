@extends('layouts.admin')

@section('content')

<div class="card card-indigosd mt-1">
  <div class="card-header">
    <h3 class="card-title">All  Agent List</h3>

    <a href="{{url('inAgent/create')}}" class="btn btn-xs btn-flat btn-outline btn-indigo float-right">Create</a>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>S.no.</th>
        <th>ID</th>
        <th>Name</th>
        <th>Contact</th>
        <th>Created By</th>
        <th>Created At</th>
        <th>Action</th>
      </tr>
      </thead>
      <tbody>
        @foreach($users as $k => $user)
        <tr>
          <td>{{$k+1}}</td>          
          <td>{{$user->email}}</td>
          <td>{{$user->name}}</td>
          <td>{{$user->contact}}</td>
          <td>{{$user->createdByInfo->name}}</td>
          <td>{{$user->created_date}}</td>
          <td>
            <form action="{{url('inAgent/'.$user->id)}}" method="POST" style="display: flex;">
              @csrf
              @method('DELETE')
              <!---->
              
              <a href="{{url('inAgent/'.$user->id.'/edit')}}"><i class="fa fa-edit text-indigo mr-1"></i></a>
              

              <!-- <a href="{{url('inAgent/'.$user->id)}}"><i class="fas fa-eye"></i></a> -->
              
              <button type="submit" class="btn-delete" onclick="return confirm('Are You Sure You Want To Delete..');">
                <i class="fa fa-trash text-danger"></i>
              </button>
              
            </form>
          </td>          
        </tr>
        @endforeach 
      </tbody>
      <tfoot>
      <tr>
        <th>S.no.</th>
        <th>ID</th>
        <th>Name</th>
        <th>Contact</th>
        <th>Created By</th>
        <th>Created At</th>
        <th>Action</th>
      </tr>
      </tfoot>
    </table>
    {{ $users->links() }}
  </div>  
  <!-- /.card-body -->
</div>

@endsection

@section('javascript')
<script>
  $(function () {
    $('#example1').DataTable({
      "paging": false,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": false,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>


@endsection