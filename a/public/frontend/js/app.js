// l'année du copyright sera dinamyque
// document.getElementById('current-year').textContent = new Date().getFullYear()


// pour recupere la position
// document.addEventListener('DOMContentLoaded', function() {
//     const useCurrentPositionCheckbox = document.getElementById('useCurrentPosition');
//     const positionInput = document.getElementById('position');
//     const latitude = document.getElementById('latitude');
//     const longitude = document.getElementById('longitude');

//     useCurrentPositionCheckbox.addEventListener('change', function() {
//         if (this.checked) {
//             if (navigator.geolocation) {
//                 navigator.geolocation.getCurrentPosition(function(position) {
//                     const Platitude = position.coords.latitude;
//                     const Plongitude = position.coords.longitude;
//                     positionInput.value = `Latitude: ${Platitude}, Longitude: ${Plongitude}`;
//                     latitude.value = Platitude;
//                     longitude.value = Plongitude;
//                 }, function(error) {
//                     console.error('Error obtaining location:', error);
//                     positionInput.value = 'Unable to retrieve location';
//                 });
//             } else {
//                 positionInput.value = 'Geolocation is not supported by this browser.';
//             }
//         } else {
//             positionInput.value = '';
//             latitude.value = '';
//             longitude.value = '';
//         }
//     });
// });


// loading page
window.onload = function() {

    // Afficher le loader
    var loader = document.getElementById('loader');
    loader.style.visibility = 'visible';
    loader.style.opacity = '1';

    // Masquer le loader après 900ms
    setTimeout(function() {
        loader.style.opacity = '0';
        loader.style.visibility = 'hidden';
    }, 900);
};


// les messages toastes
$(document).ready(function(){
    $('.toast').toast('show');
});













function deleteAudio(step) {
    if (step === 1) {
        document.querySelector('#audio1Preview').src = '';
        document.querySelector('#audio1Preview').classList.add('hidden');
        audioBlobs[0] = null;
    } else if (step === 2) {
        document.querySelector('#audio2Preview').src = '';
        document.querySelector('#audio2Preview').classList.add('hidden');
        audioBlobs[1] = null;
    }
}

document.querySelector('form').addEventListener('submit', function(event) {
    const formData = new FormData(this);

    if (audioBlobs[0]) {
        formData.append('audio1', audioBlobs[0], 'audio1.wav');
    }
    if (audioBlobs[1]) {
        formData.append('audio2', audioBlobs[1], 'audio2.wav');
    }

    fetch(this.action, {
            method: this.method,
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = data.redirect;
            } else {
                console.error('Error:', data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });

    event.preventDefault();
});



// scripte pour afficher l'image uplaod


document.getElementById('photo1').addEventListener('change', function(event) {
    const preview = document.getElementById('preview1');
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
    };

    if (file) {
        reader.readAsDataURL(file);
    }
});

document.getElementById('photo2').addEventListener('change', function(event) {
    const preview = document.getElementById('preview2');
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.onload = function(e) {
        preview.src = e.target.result;
        preview.style.display = 'block';
    };
    document.getElementById('photo1').addEventListener('change', function(event) {
        displayImage(event, 'imagePreview1');
    });

    document.getElementById('photo2').addEventListener('change', function(event) {
        displayImage(event, 'imagePreview2');
    });

    function displayImage(event, previewId) {
        const input = event.target;
        const previewContainer = document.getElementById(previewId);

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                previewContainer.innerHTML = '';
                previewContainer.appendChild(imgElement);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    if (file) {
        reader.readAsDataURL(file);
    }
});