<?php 
    //session_start();
?>

@extends('admin.home')
@section('content')

<div class='examData' style="margin-left: 50px;">
    <form id="tests" action="{{ route('createExam')}}"  method="POST" enctype="multipart/form-data"> 
        {{ csrf_field() }}
        <input type="hidden" id='oldmaky' name='oldmaky' value=<?php echo $exam->maky; ?> >
        <input type="text" id="maky" name="maky" placeholder='mã kỳ' value= <?php echo $exam->maky; ?> >
        <input type='text' readonly id='active' name='active' value= <?php echo $exam->active==0?'Deactivated':'Activated'?> class=<?php echo $exam->active==0?'deactivated':'activated'?>>
        <button class='copy' id='copy'><i class="fa fa-clone" aria-hidden="true"></i>   Copy</button> 
        <button class='delete' id='delete'><span class='fa fa-times' aria-hidden='true' ></span>   Delete</button>
        <button type='submit' id='submitTests' value='Save'> Save</button>
    </form>
        
    <div>      
        <?php 
            //dd($tests);
            if ($tests){
                foreach ($tests as $test){
                    
                    echo "<form class='createTest' method='post' style='margin:20px 0 20px 0;'>";
                    echo "<input type='hidden' id='maky' name='maky' placeholder='mã kỳ' value="."$exam->maky"." >";
                    echo "<input type='hidden' readonly id='active' name='active' value=" . "$exam->active==0?'Deactivated':'Activated'" . "  class= ". "$exam->active==0?'deactivated':'activated'" . " >";
                    echo "<input type='text' placeholder='maca' id='maca' name='maca' value='$test->maca' required>";
                    echo "<input type='text' placeholder='mahp' id='mahp' name='mahp' value='$test->mahp' required>";
                    echo "<input type='text' placeholder='tenhp' id='tenhp' name='tenhp' value='$test->tenhp' required>";
                    echo "<input type='text' placeholder='TC' id='TC' name='TC' value='$test->TC' required>";
                    echo "<input type='text' placeholder='SL' id='SL' name='SL' value='$test->SL' required>";
                    echo "<input type='text' placeholder='ca' id='ca' name='ca' value='$test->ca' required>";
                    echo "<input type='date' placeholder='date' id='date' name='date' value='$test->date' required>";
                    echo "<input type='text' placeholder='timestart' id='timestart' name='timestart' value='$test->timestart' required>";
                    echo "<input type='text' placeholder='timeend' id='timeend' name='timeend' value='$test->timeend' required>";
                    echo "<input type='text' placeholder='diadiem' id='diadiem' name='diadiem' value='$test->diadiem' required>";
                    echo "<span  class='fa fa-times' aria-hidden='true' id='remove' onclick='remove(this)'> </span>";
                    echo "</form>";
                }
            }
        ?>

        <button type="button" id='newTest'>Create new</button> 
    </div>

    
        
    
    
</div>

<?php
    if (session('request')) dd(session('request'));
?>

<script>
    $('#active').click(function() {
        if ($('#active').val() == 'Activated') {
            $('#active').val('Deactivated');
            $('#active').removeClass('activated');
            $('#active').addClass('deactivated');
        } else {
            $('#active').val('Activated');
            $('#active').removeClass('deactivated');
            $('#active').addClass('activated');
        }
    });

    $('#newTest').click(function() {
        var newInput = "<form class='createTest' method='post' style='margin:20px 0 20px 0;'>"
                        +"<input type='hidden' id='maky' name='maky' placeholder='mã kỳ' value= <?php echo $exam->maky; ?>>"
                        +"<input type='hidden' readonly id='active' name='active' value= <?php echo $exam->active==0?'Deactivated':'Activated'?> class=<?php echo $exam->active==0?'deactivated':'activated'?>>"
                        +"<input type='text' placeholder='maca' id='maca' name='maca'  required>"
                        + "<input type='text' placeholder='mahp' id='mahp' name='mahp'  required>"
                        + "<input type='text' placeholder='tenhp' id='tenhp' name='tenhp'  required>"
                        + "<input type='text' placeholder='TC' id='TC' name='TC'  required>"
                        + "<input type='text' placeholder='SL' id='SL' name='SL'  required>"
                        + "<input type='text' placeholder='ca' id='ca' name='ca'  required>"
                        + "<input type='date' placeholder='date' id='date' name='date'  required>"
                        + "<input type='text' placeholder='timestart' id='timestart' name='timestart' required>"
                        + "<input type='text' placeholder='timeend' id='timeend' name='timeend'  required>"
                        + "<input type='text' placeholder='diadiem' id='diadiem' name='diadiem'  required>"
                        + "<span  class='fa fa-times' aria-hidden='true' id='remove' onclick='remove(this)'> </span>"
                        + "</form>";
        
        //$('#submitTests').before(newInput);
        $('#newTest').before(newInput);
    });

    function remove(btn) {
        child = btn.parentNode;
        child.parentNode.removeChild(child);
    }

    $(document).ready(function(){
        $("#tests").submit(function(){
            console.log('submit');

            //khoi tao lai gia tri exam~tests
            var maky = "<?php echo $exam->maky; ?>";
            var active = "<?php echo $exam->active==0?'Deactivated':'Activated'?>";
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url:"{{route('makeup')}}",
                method:"POST", 
                data:{maky:maky, active: active, _token:_token},
                success:function(data){ 
                    result = JSON.parse(data).result;
                    console.log(result);
                    importTests();
                }
            });
            return true;
        });
    });


    function importTests() {
        var forms = $('.createTest');
        console.log(forms);
        if(forms) {
            
            for (i = 0; i < forms.length; ++i) {
                console.log(forms[i][3].value);
                
                var maky = forms[i][0].value; if (maky == '') continue;
                var active = forms[i][1].value; if (active == '') continue;
                var maca = forms[i][2].value; if (maca == '') continue;
                var mahp = forms[i][3].value; if (mahp == '') continue;
                var tenhp = forms[i][4].value; if (tenhp == '') continue;
                var TC = forms[i][5].value; if (TC == '') continue;
                var SL = forms[i][6].value; if (SL == '') continue;
                var ca = forms[i][7].value; if (ca == '') continue;
                var date = forms[i][8].value; if (date == '') continue;
                var timestart = forms[i][9].value; if (timestart == '') continue;
                var timeend = forms[i][10].value; if (timeend == '') continue;
                var diadiem = forms[i][11].value; if (diadiem == '') continue;

                var _token = $('input[name="_token"]').val();

                console.log('why?');

                $.ajax({
                    url:"{{route('createTest')}}",
                    method:"POST", 
                    data:{maky:maky, active: active, maca: maca, mahp: mahp, tenhp:tenhp, TC:TC, SL:SL, ca:ca, date:date, timestart:timestart, timeend:timeend, diadiem:diadiem, _token:_token},
                    success:function(data){ 
                        result = JSON.parse(data).result;
                        console.log(result);
                    }
                });
            }
        }
    }

    $('#delete').click(function() {
        val = confirm('Có chắc là xóa kỳ thi này?');
        if (val == true) {
            var maky = "<?php echo $exam->maky; ?>";
            var active = "<?php echo $exam->active==0?'Deactivated':'Activated'?>";
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url:"{{route('deleteExam')}}",
                method:"POST", 
                data:{maky:maky, active: active, _token:_token},
                success:function(data){ 
                    console.log(jkdls);
                    result = JSON.parse(data).result;
                    console.log(result);
                    if (result == 'success') {
                        window.location = "/exam";
                    } else alert(result);
                }
            });
        }
    });

    $('#copy').click(function() {
        maky = prompt('Nhập mã kỳ bạn muốn sao chép:');
    });

</script>


@endsection