var modalToggle = false

$('#modal-btn').on('click', function(){
    modalToggle = !modalToggle
    console.log(modalToggle)
    if (modalToggle) {
        $('#category-modal').removeClass('-top-[100vh]').addClass('top-20')
    }else{
        $('#category-modal').addClass('-top-[100vh]').removeClass('top-20')
    }
})
