@extends('frontend.layouts.user_panel')

@section('panel_content')
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Downloads</h4>
        </div>
        <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                            <form method='post' action='{{route("digital_purchase_history.download")}}' enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="dl_file">Attach PDF files</label>
                                <input type="file" class="form-control" id="dl_file" name="dl_file">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                        <form method='get' action='{{route("digital_purchase_history.index")}}'>
                        <div class="form-group">
                            <label for="file_srch">Search Files</label>
                            <input type="text" class="form-control" id="file_srch" name="file_srch" @isset($file_srch) value="{{ $file_srch }}" @endisset placeholder="">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Search</button>
                        </div>
                        </form>
                    </div>
                </div>
            
            <table class="table aiz-table mb-0">
                <thead>
                    <tr>
                        <th>{{ translate('Product')}}</th>
                        <!--<th width="20%">{{ translate('Option')}}</th>-->
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $item)
                    <tr>
                        <!--<td>{{$item->filename}}</td>-->
                        <td><a href="/digital_purchase_history/download/{{$item->filename}}" >{{$item->filename}}</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $orders->links() }}
        </div>
    </div>
@endsection
