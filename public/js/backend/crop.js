var crop_max_width = 400;
var crop_max_height = 400;
var jcrop_api;
var canvas;
var context;
var image;

var prefsize;

var currentPhoto = $(".imageUpload");

$(".imageUpload").change(function() {
  currentPhoto = $(this);
  currentPhoto.siblings('.imgPreview').hide();
  currentPhoto.siblings('#cropbutton').show();
  loadImage(this);
})

currentPhoto.siblings('#imgRemove').on("click", function(){
  $(this).siblings('input').val('');
  $(this).siblings('input').attr('data-path', '');
  $(this).siblings('.imgPreview').attr('src', '');
  $(this).siblings('.imgPreview').hide();
  $(this).hide();
});

function loadImage(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    canvas = null;
    reader.onload = function(e) {
      image = new Image();
      image.onload = validateImage;
      image.src = e.target.result;
    }
    reader.readAsDataURL(input.files[0]);
  }
}

function validateImage() {
  if (canvas != null) {
    image = new Image();
    image.onload = restartJcrop;
    image.src = canvas.toDataURL('image/png');
  } else {
    restartJcrop();
    currentPhoto.siblings('#cropbutton').trigger('click')
  }
}

function restartJcrop() {
  if (jcrop_api != null) {
    jcrop_api.disable();
  }
  var canvasId = 'canvas_'+currentPhoto.attr('id');
  currentPhoto.siblings('#views').empty();
  currentPhoto.siblings('#views').append("<canvas id="+canvasId+">");
  canvas = $('#'+canvasId)[0];
  context = canvas.getContext("2d");
  canvas.width = image.width;
  canvas.height = image.height;
  context.drawImage(image, 0, 0);
  $('#'+canvasId).Jcrop({
    onSelect: selectcanvas,
    onRelease: clearcanvas,
    boxWidth: crop_max_width,
    boxHeight: crop_max_height
  }, function() {
    jcrop_api = this;
  });
  clearcanvas();
}

function clearcanvas() {
  prefsize = {
    x: 0,
    y: 0,
    w: canvas.width,
    h: canvas.height,
  };
}

function selectcanvas(coords) {
  prefsize = {
    x: Math.round(coords.x),
    y: Math.round(coords.y),
    w: Math.round(coords.w),
    h: Math.round(coords.h)
  };
}

function applyCrop() {
  canvas.width = prefsize.w;
  canvas.height = prefsize.h;
  context.drawImage(image, prefsize.x, prefsize.y, prefsize.w, prefsize.h, 0, 0, canvas.width, canvas.height);
  validateImage();
}

currentPhoto.siblings('#cropbutton').click(function(e) {
  applyCrop();
  formData = new FormData();
  // var blob = dataURLtoBlob(canvas.toDataURL('image/png'));
  var blob = canvas.toDataURL('image/png');
  
  //---Add file blob to the form data
  formData.append("cropped_image[]", blob);
  var filInput = $(this).siblings('input')
  var url = filInput.attr('data-url');
  $.ajax({
    url: url,
    type: "POST",
    data: formData,
    contentType: false,
    cache: false,
    processData: false,
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    success: function(data) {
      if(data.success){
        filInput.attr('data-path', data.path)
        if(typeof addData !== 'undefined'){
          addData = addData + '&file['+filInput.attr('id')+']='+data.path;
        }
      }
      if(!data.success){
        currentPhoto.siblings('span').html(data.message);
      }
    },
    error: function(data) {
      alert("Error");
    },
    complete: function(data) {}
  });
});


