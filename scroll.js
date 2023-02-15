var page_no = 1;
showdata();
$('#main').on('scroll', function(){
    if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight -1) {
        showdata();
    };
});
function showdata(){
$.post("pb_tribs.php",{page:page_no},(response)=>{
    $("#main").append(response);
    page_no++;
});
};
