let navbar = document.querySelector('.navbar');
document.querySelector('#menu-bar').onclick=() =>{
    navbar.classList.toggle('active');
}



let search = document.querySelector('.search');
document.querySelector('#search').onclick=() =>{
    search.classList.toggle('active');
}

var swiper = new Swiper(".blogs-row", {
  spaceBetween: 30,
  loop:true,
  centeredSlides:true,
  autoplay:{
      delay:4000,
      disableOnInteraction:false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 1,
    },
    1024: {
      slidesPerView: 1,
    },
  },
});

var swiper = new Swiper(".product-row", {
    spaceBetween: 30,
    loop:true,
    centeredSlides:true,
    autoplay:{
        delay:6000,
        disableOnInteraction:false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });

  var swiper = new Swiper(".review-row", {
    spaceBetween: 30,
    loop:true,
    centeredSlides:true,
    autoplay:{
        delay:4000,
        disableOnInteraction:false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
    },
  });
  function searchProducts() {
    var input, filter, ul, li, i, txtValue;
    input = document.getElementById('search-input');
    filter = input.value.toUpperCase();
    ul = document.getElementById('navbar');
    li = ul.getElementsByTagName('a');
  
    for (i = 0; i < li.length; i++) {
      txtValue = li[i].textContent || li[i].innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        li[i].style.display = "";
      } else {
        li[i].style.display = "none";
      }
    }
  }
  
  // event listener ketika input search berubah
  document.getElementById('search-input').addEventListener('input', searchProducts);

  const discountIcon = document.querySelector('.discount-box')
  let showTimeout = null;

  window.addEventListener('scroll', function(){
    hideDiscountIcon();

    if(showTimeout !== null) {
      clearTimeout(showTimeout);
    }

    showTimeout = setTimeout(showDiscountIcon, 100);
  });

  function hideDiscountIcon() {
    discountIcon.style.right = '-100px';
  }

  function showDiscountIcon() {
    discountIcon.style.right = '8px';
    
  }
  function validateForm() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;

    if (password !== confirmPassword) {
      alert("Kata sandi tidak cocok.");
      return false;
    }
  }
  