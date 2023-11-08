<script setup>
  import { ref, onMounted, onBeforeUnmount } from 'vue'
  import { Link } from '@inertiajs/vue3'
  import { initFlowbite } from 'flowbite'

  defineProps({
    canLogin: Boolean,
    canRegister: Boolean
  });

  const isDropdownOpen = ref(false);
  const isDropdownOpen1 = ref(false);
  const isDropdownOpen2 = ref(false);
  const isDropdownOpen3 = ref(false);
  const isSearchOpen = ref(false);

  // initialize components based on data attribute selectors
  onMounted(() => {
    initFlowbite();
  });

  const toggleSearch = () => {
     isSearchOpen.value = !isSearchOpen.value;
   }
  // Only work for screen sizes up to 991px
  const mediaQuery = window.matchMedia('(max-width: 991px)');

  const toggleDropdown = () => {
    if (mediaQuery.matches) {
      isDropdownOpen.value = !isDropdownOpen.value;
    }
  }

  const toggleDropdown1 = () => {
    if (mediaQuery.matches) {
      isDropdownOpen1.value = !isDropdownOpen1.value;
    }
  }

  const toggleDropdown2 = () => {
    if (mediaQuery.matches) {
      isDropdownOpen2.value = !isDropdownOpen2.value;
    }
  }

  const toggleDropdown3 = () => {
    if (mediaQuery.matches) {
      isDropdownOpen3.value = !isDropdownOpen3.value;
    }
  }

  // Cleanup media query listener on component unmount
  onBeforeUnmount(() => {
    mediaQuery.removeEventListener('change', handleMediaQueryChange);
  });
</script>


<template>
   <nav class="sticky top-0 bg-white z-10 nav flex flex-wrap items-center justify-end px-5 md:px-10">
      <input class="menu-btn hidden" type="checkbox" id="menu-btn">
      <label class="menu-icon block cursor-pointer lg:hidden py-4 px-2 relative select-none" for="menu-btn">
      <span class="navicon bg-grey-darkest flex items-center relative"></span>
      </label>
      <ul class="menu border-b border-primary lg:border-none flex justify-end list-reset m-0 w-full lg:w-auto lg:gap-3 xl:gap-5">
         <div class="flex-col lg:flex-row flex items-start lg:items-center gap-5 lg:gap-3 xl:gap-5 2xl:gap-10 w-full lg:w-auto">
            
            <li v-if="$page.props.auth.user" class="block lg:hidden">
               <Link :href="route('dashboard')" class="block lg:hidden text-sm text-primary font-semibold">
               Dashboard</Link>
            </li>
            <li v-if="!$page.props.auth.user" class="block lg:hidden">
               <Link :href="route('track')" class="block lg:hidden text-sm text-primary font-semibold">
               Track ticket</Link>
            </li>
            <li v-if="!$page.props.auth.user" class="block lg:hidden">
               <Link :href="route('register')" class="block lg:hidden text-sm text-primary font-semibold">
               Sign up</Link>
            </li>
            <li v-if="!$page.props.auth.user" class="block lg:hidden">
               <Link :href="route('login')" class="text-sm text-primary font-semibold">
               Sign in</Link>
            </li>
         </div>
         <li v-if="$page.props.auth.user" class="border-none hidden lg:block">
            <Link :href="route('dashboard')">
            <button type="button"
               class="text-center text-sm text-white font-semibold bg-purple-200 border border-primary rounded-full px-8 py-2 my-5">
            Dashboard
            </button>
            </Link>
         </li>
         <li class="border-none hidden lg:block">
            <Link v-if="!$page.props.auth.user" :href="route('track')">
            <button type="button"
               class="text-center text-sm text-primary font-semibold bg-white border border-primary  rounded-full px-8 py-2 my-0 lg:my-5">
            Track ticket
            </button>
            </Link>
         </li>
         <li class="border-none hidden lg:block">
            <Link v-if="!$page.props.auth.user" :href="route('register')">
            <button type="button"
               class="text-center text-sm text-primary font-semibold bg-white border border-primary  rounded-full px-8 py-2 my-0 lg:my-5">
            Sign
            up
            </button>
            </Link>
         </li>
         <li class="border-none hidden lg:block">
            <Link  v-if="!$page.props.auth.user" :href="route('login')">
            <button type="button"
               class="text-center text-sm text-white font-semibold bg-purple-200 border border-primary rounded-full px-8 py-2 my-5">
            Sign
            in
            </button>
            </Link>
         </li>
      </ul>
      <!-- Responsive Search Bar -->
      <div v-if="isSearchOpen" class="absolute top-0 left-0 w-full h-full bg-white z-50 Search">
         <div class="flex justify-end p-5">
            <button @click="toggleSearch" class="text-primary">
            <i class="fa fa-times text-white bg-primary flex items-center justify-center w-[30px] h-[30px] rounded-xl"
               aria-hidden="true"></i>
            </button>
         </div>
         <div class="px-5 flex justify-center">
            <div class="fb-input-search flex items-center gap-3">
               <input type="text" placeholder="Find..."
                  class="fb-input text-primary rounded-xl text-2xl w-[250px] sm:w-[450px]">
               <button><i
                  class="fa fa-search fb-input-icon text-white bg-primary flex items-center justify-center w-[45px] h-[45px] rounded-xl"></i></button>
            </div>
         </div>
      </div>
   </nav>
   <!----------------------------------------------------------------------------------->
</template>
<style>

@media (min-width: 991px) {
    .close-icon {
      display: none;
    }
  }
  
   .Search {
   background-color: rgba(0, 0, 0, 0.315) !important;
   position: fixed;
   left: 0;
   top: 0;
   width: 100%;
   height: 100%;
   background: rgba(0, 0, 0, 0.9);
   background-color: rgba(0, 0, 0, 0.9);
   background-color: rgba(0, 0, 0, 0.9);
   z-index: 99;
   padding: 4%;
   transition: all 0.5s;
   }
   @media (max-width: 991px) {
   .navicon {
   width: 1.125em;
   height: .125em;
   }
   .navicon::before,
   .navicon::after {
   display: block;
   position: absolute;
   width: 100%;
   height: 100%;
   transition: all .20s ease-out;
   content: '';
   background: #14532d;
   }
   .navicon::before {
   top: 5px;
   }
   .navicon::after {
   top: -5px;
   }
   .menu-btn:not(:checked)~.menu {
   max-height: 0;
   opacity: 0;
   overflow: hidden;
   transition: max-height 0.5s cubic-bezier(0.42, 0, 0.58, 1), opacity 0.3s ease-out;
   }
   .menu-btn:checked~.menu {
   max-height: 1000px; /* Set this value to a large number to ensure it covers all menu content */
   opacity: 1;
   transition: max-height 0.8s cubic-bezier(0.42, 0, 0.58, 1), opacity 0.3s ease-in;
   }
   .menu-btn:checked~.menu-icon .navicon {
   background: transparent;
   }
   .menu-btn:checked~.menu-icon .navicon::before {
   transform: rotate(-45deg);
   }
   .img-btn:click{
   transform: rotate(-180deg);
   }
   .menu-btn:checked~.menu-icon .navicon::after {
   transform: rotate(45deg);
   }
   .menu-btn:checked~.menu-icon .navicon::before,
   .menu-btn:checked~.menu-icon .navicon::after {
   top: 0;
   }
   #dropdown-awarding,
   #dropdownHover,
   #dropdownHover1,
   #dropdownHover2,
   #dropdownHover3 {
   position: absolute;
   inset: 0px 0px auto 0px !important;
   margin: 0px;
   transform: translate(0px, 235px);
   width: 90%;
   }
   .close-icon {
   font-size: 15px;
   color: #14532d;
   font-weight: bold;
   transform: scaleX(1.4);
   margin-right: 12px;
   }
   }
</style>
