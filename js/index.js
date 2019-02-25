//************************************************************************
//Función axiliar que reconoce el evento del scroll
//************************************************************************
$.fn.scrollEnd = function(callback, timeout)
{
  $(this).scroll(function()
  {
    var $this = $(this);
    if ($this.data('scrollTimeout'))
    {
      clearTimeout($this.data('scrollTimeout'));
    }
    $this.data('scrollTimeout', setTimeout(callback,timeout));
  });
};

//************************************************************************
//Función que inicializa el Slider
//************************************************************************
function inicializar()
{
  $("#rangoPrecio").ionRangeSlider(
    {
      type: "double",
      grid: false,
      min: 0,
      max: 100000,
      from: 200,
      to: 80000,
      prefix: "$"
    });
}

//************************************************************************
//Función que reproduce el video del background
//************************************************************************
function reproducirVideo()
{
  var ultimoScroll = 0,
      intervalRewind;
  var video = document.getElementById('vidFondo');
  $(window)
    .scroll((event)=>{
      var scrollActual = $(window).scrollTop();
      if (scrollActual > ultimoScroll)
      {
         video.play();
      } else {
        video.play();
      }
      ultimoScroll = scrollActual;
    })
    .scrollEnd(()=>{
      video.play();
    }, 10)
}

inicializar();
reproducirVideo();
