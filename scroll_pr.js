var page_no_pr = 1;
showdata_pr();
$('#right_nav').on('scroll', function(){
    if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight -1) {
        showdata_pr();
    };
});
function showdata_pr(){
$.post("pr_tribs.php",{page_pr:page_no_pr},(response)=>{
    $("#right_nav").append(response);
    page_no_pr++;
});
};