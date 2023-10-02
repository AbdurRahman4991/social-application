
$(document).on('submit','#PostLike',function(event){  
    event.preventDefault();
    let data = $(this).serialize();
    axios.post("http://localhost/socialApp/public/like/post", data).then(data=>{
        console.log('hello world');
    }).catch(error=>{
        console.log(error)
    })
})

