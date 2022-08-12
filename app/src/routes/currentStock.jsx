export default function CurrentStock() {
    return (
        <main style={{  }}>
            {/* Start of Main Page */}
           
<div class="bg-gray-100 h-screen">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto py-16 sm:py-24 lg:py-32 lg:max-w-none">
      <h2 class="text-2xl font-extrabold text-gray-900 text-center align-top ">Current Stock</h2>

      <div class="mt-6 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-x-6">
        {/* Single Card Start */}
        <div class="group relative">
          <div class="relative w-full bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
            <img src="https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/c013660a-93fe-48eb-bd2f-ca731d344905/fitness-hoodie-QbMW7g.png" alt="Sweatshirts in this category" class="w-full h-full object-center object-cover"></img>
          </div>
          <h3 class="mt-3 text-sm text-gray-500">
            <a href="#">
              <span class="absolute inset-0"></span>
              4 Views
            </a>
          </h3>
          <h3 class="mt-1 text-sm text-gray-500">
            <a href="#">
              <span class="absolute inset-0"></span>
              250 Items Left
            </a>
          </h3>
          <p class="text-center text-base font-semibold text-gray-900">SWEATSHIRTS</p>
        </div>
        {/* Single Card End */}

        {/* Single Card Start */}
        <div class="group relative">
          <div class="relative w-full bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
            <img src="https://assets.adidas.com/images/h_2000,f_auto,q_auto,fl_lossy,c_fill,g_auto/ff609898af2e4bc09843ad0b0081ba4e_9366/Future_Icons_Logo_Graphic_Hoodie_Green_GU8969_21_model.jpg" alt="Hoodies in this category" class="w-full h-full object-center object-cover"></img>
          </div>
          <h3 class="mt-3 text-sm text-gray-500">
            <a href="#">
              <span class="absolute inset-0"></span>
              3 Views
            </a>
          </h3>
          <h3 class="mt-1 text-sm text-gray-500">
            <a href="#">
              <span class="absolute inset-0"></span>
              350 Items Left
            </a>
          </h3>
          <p class="text-center text-base font-semibold text-gray-900">HOODIES</p>
        </div>
        {/* Single Card End */}

          {/* Single Card Start */}
          <div class="group relative">
          <div class="relative w-full bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
            <img src=" https://assets.adidas.com/images/h_2000,f_auto,q_auto,fl_lossy,c_fill,g_auto/e90555b7501b49439070ae5500a95478_9366/Adicolor_SST_Track_Jacket_Blue_HK0298_01_laydown.jpg" alt="Hoodies in this category" class="w-full h-full object-center object-cover"></img>
          </div>
          <h3 class="mt-3 text-sm text-gray-500">
            <a href="#">
              <span class="absolute inset-0"></span>
              1 Views
            </a>
          </h3>
          <h3 class="mt-1 text-sm text-gray-500">
            <a href="#">
              <span class="absolute inset-0"></span>
              550 Items Left
            </a>
          </h3>
          <p class="text-center text-base font-semibold text-gray-900">JACKETS</p>
        </div>
        {/* Single Card End */}
       
{/*     End of Main Div */}
      </div> 
    </div>
  </div>
</div>

            {/* End of Main Page */}
        </main>
    );
}