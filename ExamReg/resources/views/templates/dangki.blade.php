@extends('templates.home')
@section('content')
		<div class="form_dangky">
	  	<form >
			<table id = "tb1" class="table center" border="1px" style="font-family: 'Times new roman'">
				<thead>
				   
					<th>Mã ca thi</th>
                    <th>Mã môn học</th>
                    <th>Tên môn học</th>
					<th>Ca thi</th>
					<th>Phòng thi</th>
					<th>Ngày thi</th>
                    <th>Giờ bắt đầu</th>
                    <th>Giờ kết thúc</th>
                    <th>Số lượng</th>
					<th>Tín chỉ</th>
					<th>Mã kì</th>
					<th>Đăng kí</th>
				
				</thead>
				<tbody id="dtd">
                @foreach($examinations as $key => $examination)
            <tr class="row_sb" data-date = "{{ $examination->date }}" data-ca = "{{ $examination->ca }}" data-maca = "{{ $examination->maca }}" data-tenhp="{{$examination->tenhp}}">
			
				<td style="text-align: center;" class="maca">{{ $examination->maca}}</td>
                <td style="text-align: center;" class="mon">{{$examination->mahp}}</td>
                <td style="text-align: center;" class="mon">{{$examination->tenhp}}</td>
                <td style="text-align: center;" >{{$examination->ca}}</td>
                <td style="text-align: center;">{{$examination->diadiem}}</td>
                <td style="text-align: center;" class="ngay">{{$examination->date}}</td>
                <td style="text-align: center;">{{$examination->timestart}}</td>
                <td style="text-align: center;">{{$examination->timeend}}</td>
                <td style="text-align: center;" class="total">{{$examination->SL}}</td>
				<td style="text-align: center;" class="count">{{$examination->TC}}</td>
				<td style="text-align: center;" class="maki">{{ $examination->maky}}</td>
                <td style="text-align: center;" class="nut"><input id = "action" class="chon" type="checkbox" name="gender"></td>
            </tr>
        @endforeach
				</tbody>
			</table>
		</form> 
		<br><br>
		<form action="" method="post" enctype="multidata/form-data" class="a">
			<table class="ketqua" class="table center" width=100% border="1px" style="font-family: 'Times new roman'">
				<thead class="center">
					<th>Mã ca thi</th>
					<th>Môn học</th>
					<th>Mã môn học</th>
					<th>Ca thi</th>
					<th>Mã kì</th>
					<th>Phòng thi</th>
					<th>Ngày thi</th>
					<th>Hủy môn</th>
				</thead>
	        </table> 
		</form>
		<input onclick="myfunction()" type="submit" id = "button_dangky"class="btn btn-success" value="Ghi nhận" name="">
	</div>
	
@endsection
