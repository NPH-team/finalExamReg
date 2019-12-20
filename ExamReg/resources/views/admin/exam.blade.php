<?php 
    session_start();
?>

@extends('admin.home')
@section('content')

<div class='examData' style="margin-left: 50px;">
    <form id="testes" action="{{ url('/exam/{}')}}"  method="POST" enctype="multipart/form-data"> 
        {{ csrf_field() }}

        <input type="text" id="maky" placeholder='mã kỳ' value= <?php echo $exam[0]; ?> >
        <input type='button' id='active' value= <?php echo $exam[1]==0?'Deactivated':'Activated'?> class=<?php echo $exam[1]==0?'deactivated':'activated'?>>
        <br><br>
        <?php
            if ($tests){
                foreach ($tests as $test){
                    echo "<input type='text' placeholder='maca' id='maca' style='float:left;' value=".$test[1].">";
                    echo "<input type='text' placeholder='mahp' id='mahp' style='' value=".$test[2].">";
                    echo "<input type='text' placeholder='tenhp' id='tenhp' style='' value=".$test[3].">";
                    echo "<input type='text' placeholder='TC' id='TC' style='' value=".$test[4].">";
                    echo "<input type='text' placeholder='SL' id='SL' style='' value=".$test[5].">";
                    echo "<input type='text' placeholder='ca' id='ca' style='' value=".$test[6].">";
                    echo "<input type='date' placeholder='date' id='date' style='' value=".$test[7].">";
                    echo "<input type='text' placeholder='timestart' id='timestart' style='' value=".$test[8].">";
                    echo "<input type='text' placeholder='timeend' id='timeend' style='' value=".$test[9].">";
                    echo "<input type='text' placeholder='diadiem' id='diadiem' style='clear:both' value=".$test[10].">";
                    echo "<br>";
                }
            }
        ?>

        <input type='text' placeholder='maca' id='maca' value=''>
        <input type='text' placeholder='mahp' id='mahp' value=''>
        <input type='text' placeholder='tenhp' id='tenhp' value=''>
        <input type='text' placeholder='TC' id='TC' value=''>
        <input type='text' placeholder='SL' id='SL' value=''>
        <input type='text' placeholder='ca' id='ca' value=''>
        <input type='date' placeholder='date' id='date' value=''>
        <input type='text' placeholder='timestart' id='timestart' value=''>
        <input type='text' placeholder='timeend' id='timeend' value=''>
        <input type='text' placeholder='diadiem' id='diadiem' value=''>
        <br><br>

        <input type='submit' id='submitTests' value='Save'>
    </form>
    <button type="button" id='newTest'>Create new</button> 
</div>

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
        console.log('new');

        var newInput = "<input type='text' placeholder='maca' id='maca' value=''>"
                    + "<input type='text' placeholder='mahp' id='mahp' value=''>"
                    + "<input type='text' placeholder='tenhp' id='tenhp' value=''>"
                    + "<input type='text' placeholder='TC' id='TC' value=''>"
                    + "<input type='text' placeholder='SL' id='SL' value=''>"
                    + "<input type='text' placeholder='ca' id='ca' value=''>"
                    + "<input type='date' placeholder='date' id='date' value=''>"
                    + "<input type='text' placeholder='timestart' id='timestart' value=''>"
                    + "<input type='text' placeholder='timeend' id='timeend' value=''>"
                    + "<input type='text' placeholder='diadiem' id='diadiem' value=''>"
                    + "<br><br>";
        
        //console.log
        $('#submitTests').before(newInput);
    });

</script>


@endsection