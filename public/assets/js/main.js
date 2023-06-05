(function () {
	"use strict";


	/*----------------------------------------------------------------------------------------*/
	/*----------------------------------------------------------------------------------------*/
	// Reboot
	let clicks = document.querySelectorAll("a[href='#']")
	clicks.forEach(element => {
		element.addEventListener('click', (event) => {
			event.preventDefault()
		})
	});

	/*----------------------------------------------------------------------------------------*/
	/*----------------------------------------------------------------------------------------*/
	// Back to top
	let backToTop = document.getElementById("back-to-top")

	backToTop.onclick = () => {
		window.scrollTo({
			top: 0,
			left: 0,
			behavior: 'smooth'
		});
	}

	/*----------------------------------------------------------------------------------------*/
	/*----------------------------------------------------------------------------------------*/
	// Sidemenu
	var sidemenu_open = document.querySelector(".sidemenu__open");
	var sidemenu_close = document.querySelector(".sidemenu__close");

	function openNav() {
		document.querySelector(".sidemenu").style.transform = "translateX(0)";
	}

	function closeNav() {
		document.querySelector(".sidemenu").style.transform = "translateX(-100%)";
	}

	sidemenu_open.addEventListener('click', openNav, false);
	sidemenu_close.addEventListener('click', closeNav, false);

	/*----------------------------------------------------------------------------------------*/
	/*----------------------------------------------------------------------------------------*/
	// Image preview
	const inputImages = document.getElementById("input_images")
	const inputPreview = document.getElementById("input_preview")

	function updatePreviews() {
		if (inputImages.files) {
			Array.from(inputImages.files).forEach(file => {
				let reader = new FileReader()


				reader.onloadend = () => {
					let node = document.createElement("div")
					node.classList.add("grid-item", "p-0")

					let img = document.createElement("img")
					img.classList.add("img-preview")
					img.src = reader.result;

					let button = document.createElement("button")
					button.classList.add("btn", "btn-danger", "img-preview-remove")
					button.innerHTML = "<i class='fas fa-trash-alt'></i>"

					node.appendChild(img)
					node.appendChild(button)

					inputPreview.appendChild(node)
				}

				reader.readAsDataURL(file);
			});
		}
	}

	if (inputImages) {
		inputImages.addEventListener('change', updatePreviews, false)
	}

	/*----------------------------------------------------------------------------------------*/
	/*----------------------------------------------------------------------------------------*/
	// Store logo and banner preview
	const logoInput = document.getElementById("logo_input")
	const bannerInput = document.getElementById("banner_input")
	const logoPreview = document.getElementById("logo_preview")
	const bannerPreview = document.getElementById("banner_preview")

	function updateImage(input, preview) {
		if (input.files) {
			let reader = new FileReader()

			reader.onloadend = () => {
				preview.src = reader.result
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	const updateLogo = () => {
		updateImage(logoInput, logoPreview)
	}

	const updateBanner = () => {
		updateImage(bannerInput, bannerPreview)
	}
	
	if (logoInput && bannerInput) {
		logoInput.addEventListener('change', updateLogo, false)
		bannerInput.addEventListener('change', updateBanner, false)
	}

	/*----------------------------------------------------------------------------------------*/
	/*----------------------------------------------------------------------------------------*/
	// Slick Carousel
	// 1 - Main Slider
	$('.slider.slider--main .slider__container').slick({
		autoplay: true,
		autoplaySpeed: 3500,
		arrows: true,
		prevArrow: "<button class='slider__nav slider__nav--prev btn btn-primary'><i class='fas fa-angle-left'></i></button>",
		nextArrow: "<button class='slider__nav slider__nav--next btn btn-primary'><i class='fas fa-angle-right'></i></button>",
		dots: true,
		responsive: [
			{
				breakpoint: 992,
				settings: {
					arrows: false
				}
			}
		]
	});

	// 2 - All home Slider
	$('.slider.slider--home .slider__container').slick({
		autoplay: true,
		autoplaySpeed: 5000,
		arrows: true,
		prevArrow: "<button type='button' class='btn btn-primary slider__nav slider__nav--prev'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
		nextArrow: "<button type='button' class='btn btn-primary slider__nav slider__nav--next'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
		dots: false,
		slidesToShow: 4,
		slidesToScroll: 4,
		responsive: [
			{
				breakpoint: 576,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					centerMode: true,
					centerPadding: '30px'
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2,
				}
			},
			{
				breakpoint: 992,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
				}
			},
			{
				breakpoint: 1200,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 4,
				}
			}
		]
	});

	// 3 - Product Show
	$('.slider.slider-show').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		prevArrow: "<button type='button' class='btn btn-primary slider__nav slider__nav--prev'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
		nextArrow: "<button type='button' class='btn btn-primary slider__nav slider__nav--next'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
		dots: false,
		fade: true,
		asNavFor: '.slider.slider-nav'
	});
	// 4 - Product Gallery
	$('.slider.slider-nav').slick({
		slidesToShow: 5,
		slidesToScroll: 5,
		asNavFor: '.slider.slider-show',
		dots: false,
		arrows: false,
		centerMode: true,
		focusOnSelect: true,
		responsive: [
			{
				breakpoint: 576,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2,
				}
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
				}
			},
			{
				breakpoint: 992,
				settings: {
					slidesToShow: 4,
					slidesToScroll: 4,
				}
			},
			{
				breakpoint: 1200,
				settings: {
					slidesToShow: 5,
					slidesToScroll: 5,
				}
			}
		]
	});

})();



/*Script Function*/
var ImagesScrollLoad = new Object();
function showphone() {
    $("#show-phone").toggle();
}
function convertToSlug(e) {
    return e
        .toLowerCase()
        .replace(/ /g, "-")
        .replace(/[^\w-]+/g, "");
}
function showload() {
    $("#cargando").css("display", "inline");
}
function hideload() {
    $("#cargando").css("display", "none");
}
function filtro_search(e = null, t = null, o = null) {
    showload();
    var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
			window.location.href = "";
	    }
  	};
	xhttp.open("GET", "/filtro-search?argument="+e+"&id="+o+"&atribute="+t, true);
	xhttp.send();
}
function drop_filtro(e) {
    showload();
    var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
			window.location.href = "";
	    }
  	};
  	xhttp.open("GET", "/drop_filtro?key="+e, true);
	xhttp.send();
}
function change_servicio_status(e, t) {
    $.get("/servicios/status", { status: t, id: e }, function (e) {
        toastr.success("Proceso realizado", "SERVICIO ACTUALIZADO"), $("#lisTeventSearch").load("/autoload_servicios");
    });
}
 

function delete_image(e) {
    showload();
    var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	    	var response = JSON.parse(this.responseText);
	    	if (response["response"]==true){
	    		$("#editImagen"+e).hide("slow");
	    	} 
			hideload();
	    }
  	};
	xhttp.open("GET", "/delete_image?id="+e, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send();
}
function deletepublication(e, t) {
    showload();
    var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	    	var response = JSON.parse(this.responseText);

	    	if (response["response"]==true){
	    		$(".hideEvento"+e).hide("slow");
	    	}else if (response["response"]==false) {

	    	}
			hideload();
	    }
  	};
	xhttp.open("GET", "/deletepublication/"+e, true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send();
}
function change_status(e, t) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.location.reload();
    }
  };
  xhttp.open("GET", "/change_status/"+e+"/"+t, true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send();
}

function publiseaech(e) {
    if (0 != e.length) {
        var t = new XMLHttpRequest();
        (t.onreadystatechange = function () {
            4 == t.readyState && 200 == t.status && (document.getElementById("lisTeventSearch").innerHTML = t.responseText);
        }),
            t.open("GET", "/buscarmispublicaciones/" + e, !0),
            t.send();
    } else document.location.reload();
}
function emailValidacion() {

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
	    var a = JSON.parse(this.responseText);
    	toastr(a["status"],a["msg"]);
    }
  };
  xhttp.open("GET", "/validateUser", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send();
}
function deleteAtribute(e, t, o) {

    showload();
    var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	    	var a = JSON.parse(this.responseText);

	    	if (a["status"]==false) {
	    		return;
	    	}
	    	if (o=="color"){
	    		$("#color"+t).hide("slow")
	    	}else if (o=="talle"){
	    		$("#talle"+t).hide("slow");
	    	}
			hideload();
	    }
  	};
	xhttp.open("GET", "/quitAtributo?post_id="+e+"&atributo_id="+t+"&atribute="+o+"", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send();
}

(ImagesScrollLoad.images = null),
    (ImagesScrollLoad.loadImages = function () {
        var e = $(window).scrollTop() + $(window).height(),
            t = ImagesScrollLoad.images.filter("[data-src-load]");
        t.each(function (t, o) {
            var n = $(o);
            n.offset().top < e && (n.attr("src", n.attr("data-src-load")), n.removeAttr("data-src-load"));
        }),
            (ImagesScrollLoad.loadImages = t);
    }),
    $(document).ready(function () {
        (ImagesScrollLoad.images = $(".index-img")
            .css("opacity", "0")
            .bind("load", function () {
            	this.style.opacity=1;
                //$(this).animate({ opacity: "1" });
            })),
            $(window).bind("scroll", ImagesScrollLoad.loadImages),
            ImagesScrollLoad.loadImages();
    }),

    $("form").submit(function () {
        showload();
    }),
 
 
    $(document).ready(function () {
        $("#provincia_id").change(function () {
            $("#provincia_id option:selected").each(function () {
                elegido = $(this).val();
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				    if (this.readyState == 4 && this.status == 200) {
                        $("#localidad_id").html(this.responseText);
				    }
  				};

				xhttp.open("GET", "/lista-localidades?elegido="+elegido, true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send();

            });
        });
    });

 

function adminsearch() {
  var n = $("#pubname").val();
  var c = $("#pubcategory").val();
  var o = $("#puborden").val();
  window.location = "/ventas?buscar="+n+"&category_id="+c+"&orden="+o;
}

function filter_consultas() {
    var t = $("#fecha").val();
    var n = $("#pub_name").val();
    var o = $("#orden").val();
  	window.location = "/interesados?fecha="+t+"&name="+n+"&orden="+o;
}
