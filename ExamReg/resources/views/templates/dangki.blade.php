@extends('templates.home')
@section('content')

    <table border="1px" width="100%" id="loadata" class="table-responsive-md"
           style="margin-top: 50px;font-family: 'times new roman';">
        <tr>
            <th style="text-align: center;">Số thứ tự</th>
            <th style="text-align: center;"></th>
            <th style="text-align: center;">Mã kỳ</th>
            <th style="text-align: center;">Mã ca</th>
            <th style="text-align: center;">Tên học phần</th>
            <th style="text-align: center;">Số lượng</th>
            <th style="text-align: center;">Ngày thi</th>
            <th style="text-align: center;">Giờ bắt đầu</th>
            <th style="text-align: center;">Giờ kết thúc</th>
            <th style="text-align: center;">Địa điểm</th>

        </tr>
        @foreach($examinations as $key => $examination)
            <tr data-date = "{{ $examination->date }}" data-ca = "{{ $examination->ca }}" data-maca = "{{ $examination->maca }}">
                <td style="text-align: center;">{{ $key + 1 }}</td>
                <td style="text-align: center;"><input type="checkbox" class="choose"></td>
                <td style="text-align: center;">{{$examination->maky}}</td>
                <td style="text-align: center;">{{$examination->maca}}</td>
                <td style="text-align: center;">{{$examination->tenhp}}</td>
                <td style="text-align: center;">{{$examination->sl}}</td>
                <td style="text-align: center;" class="ngay">{{$examination->date}}</td>
                <td style="text-align: center;">{{$examination->timestart}}</td>
                <td style="text-align: center;">{{$examination->timeend}}</td>
                <td style="text-align: center;">{{$examination->diadiem}}</td>
            </tr>
        @endforeach
    </table>
    <button type="submit" value="submit" id="submit" style="float: right; margin-top:5px; background-color: green;">Ghi
        nhận
    </button>
@endsection
