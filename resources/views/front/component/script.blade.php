
<script src="{{ asset('front/js/bootstrap.min.js') }}"></script>

@stack('plugin_js')
@stack('custom_js')

<script>
    // Password Show Hide;
    let showHideIcons = document.querySelectorAll('.show-hide-password');
    if(showHideIcons.length > 0) {
        Array.from(showHideIcons).forEach(element => {
            let icon = element.querySelector('.show-hide-icon');
            let input = element.querySelector('input');
            icon.addEventListener('click', function(e) {
                e.preventDefault();
                if(e.target.innerHTML == 'SHOW') {
                    e.target.innerHTML = 'HIDE'; 
                    input.setAttribute('type', 'text');
                } else {
                    e.target.innerHTML = 'SHOW';
                    input.setAttribute('type', 'password')
                }
            })
            console.log(icon);
        });
    }


    // Image Preview;
    let imagePreview = document.querySelectorAll('.image-preview');
    if(imagePreview.length > 0) {
        Array.from(imagePreview).forEach(element => {
            let imgElem = element.querySelector('img');
            let input = element.querySelector('input');

            input.addEventListener('change', function() {
                const [file] = input.files
                if (file) {
                    imgElem.src = URL.createObjectURL(file)
                }
            })
        })
    }
    
</script>