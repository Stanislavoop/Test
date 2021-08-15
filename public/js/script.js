$(document).ready(function (){
    $('.sort').on('click', function (){
        let order = $(this).data('order');
        console.log(order);
        $.ajax({
            url: "{{route('show')}}",
        });
    });
});
