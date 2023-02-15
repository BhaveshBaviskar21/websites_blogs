const image_input = document.querySelector("#tribphoto");
var displayimage = "";
image_input.addEventListener("change",function(){
    const reader = new FileReader();
    reader.addEventListener("load",()=>{
        displayimage = reader.result;
        document.querySelector("#display_box").style.backgroundImage = `url(${displayimage})`;
    })
    reader.readAsDataURL(this.files[0]);
})