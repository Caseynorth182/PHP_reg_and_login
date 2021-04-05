document.addEventListener('DOMContentLoaded', function () {
    const form      = document.querySelector('.form_big'),
          btn       = document.querySelector('.btn');
         toast      = document.querySelector('.toast');
         toast_body = document.querySelector('.toast-body');
         toast_btn  = document.querySelector('.close');


    toast_btn.addEventListener('click', function () {
       toast.classList.remove('show');
    });

    btn.addEventListener('click', send);

    function send(){
        form.addEventListener('submit', function (e){
            e.preventDefault();
            let xhr = new XMLHttpRequest();
            xhr.addEventListener('readystatechange', function (){
                if(this.readyState === 4 && this.status === 200) {
                    console.log(this.responseText);
                    toast.classList.add('show');
                    toast_body.innerHTML = 'Ваше письмо отправлено';
                }

            })
            let form_data = new FormData(form);
            xhr.open('POST','./send.php');
            xhr.send(form_data);
            this.reset();
            setTimeout(() => {
                toast.classList.remove('show')
            } , 3000)

        });

    }



});