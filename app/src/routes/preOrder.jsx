import React, { useState, useEffect } from "react";
import axios from "axios";
import { useSearchParams, useNavigate } from "react-router-dom";
import "tw-elements";
import Statusbar from "../components/Statusbar";

export default function PreOrder() {
    const [items, setItems] = useState([]);
    // const [searchParams, setSearchParams] = useSearchParams();
    const [batchItem, setBatch] = useState([]);
    // const navigate = useNavigate();

  useEffect(() => {
    axios.get(`http://127.0.0.1:8000/api/pre-order`).then((res) => {
      setItems(res.data);
    });
  }, []);

  //Get batch by filter
  const filterBatch = (batch) => {
    const payload = { batch };
    axios
      .post("http://127.0.0.1:8000/api/pre-order/batch", payload)
      .then((res) => {
      if(res.data != "No Fresh Stock")
      {
        setBatch(res.data);
        setItems(0);
        localStorage.setItem("preOrder", JSON.stringify(res.data));
      }
      else
      {
        alert(res.data)
      }
        //   navigate(`/carousel?category=${res.data[0][0].item_category}`)
      })
      .catch((error) => {
        console.log("Batch Not Found");
      });
  };

  return (
    <>
    <Statusbar />
    <main class="max-h-full">
      <div class="max-w-7xl mx-auto px-4 sm:my-10 sm:px-6 lg:px-8">
        {/* Dropdown */}
        <div class="flex justify-center">
          <div>
            <div class="dropdown relative">
              <button
                class="
          dropdown-toggle
          px-6
          py-2.5
          bg-gray-600
          text-white
          font-medium
          text-xs
          leading-tight
          uppercase
          rounded
          shadow-md
          hover:bg-green-700 hover:shadow-lg
          focus:bg-gray-400 focus:shadow-lg focus:outline-none focus:ring-0
          active:bg-gray-400 active:shadow-lg active:text-white
          transition
          duration-150
          ease-in-out
          flex
          items-center
          whitespace-nowrap
        "
                type="button"
                id="dropdownMenuButton1"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                Batch Filter by Date
                <svg
                  aria-hidden="true"
                  focusable="false"
                  data-prefix="fas"
                  data-icon="caret-down"
                  class="w-2 ml-2"
                  role="img"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 320 512"
                >
                  <path
                    fill="currentColor"
                    d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"
                  ></path>
                </svg>
              </button>
              <ul
                class="
          dropdown-menu
          min-w-max
          absolute
          hidden
          bg-green-100
          text-base
          z-50
          float-left
          py-2
          list-none
          text-left
          rounded-lg
          shadow-lg
          mt-1
          hidden
          m-0
          bg-clip-padding
          border-none
        "
                aria-labelledby="dropdownMenuButton1"
              >
                <li onClick={() => filterBatch("Batch Arriving Soonest")}>
                  <a
                    class="
              dropdown-item
              text-sm
              py-2
              px-4
              font-normal
              block
              w-full
              whitespace-nowrap
              bg-transparent
              text-gray-700
              hover:bg-green-400
            "
                    href="#"
                  >
                    Batch Arriving Soonest
                  </a>
                </li>
                <li onClick={() => filterBatch("Batch Arriving Second")}>
                  <a
                    class="
              dropdown-item
              text-sm
              py-2
              px-4
              font-normal
              block
              w-full
              whitespace-nowrap
              bg-transparent
              text-gray-700
              hover:bg-green-400
            "
                    href="#"
                  >
                    Batch Arriving Second
                  </a>
                </li>
                <li onClick={() => filterBatch("Batch Arriving Third")}>
                  <a
                    class="
              dropdown-item
              text-sm
              py-2
              px-4
              font-normal
              block
              w-full
              whitespace-nowrap
              bg-transparent
              text-gray-700
              hover:bg-green-400
            "
                    href="#"
                  >
                    Batch Arriving Third
                  </a>
                </li>

                <li onClick={() => filterBatch("Batch Arriving Fourth")}>
                  <a
                    class="
              dropdown-item
              text-sm
              py-2
              px-4
              font-normal
              block
              w-full
              whitespace-nowrap
              bg-transparent
              text-gray-700
              hover:bg-green-400
            "
                    href="#"
                  >
                    Batch Arriving Fourth
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        {/* 
                ============================================================= */}

        <div class="max-w-2xl mx-auto py-4 sm:py-8 lg:py-16 lg:max-w-none">
          <h2 class="text-2xl font-extrabold text-gray-900 text-center align-top ">
            Pre Order
          </h2>
          <div class="mt-6 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-x-6">
            {
              items.length > 0 &&
                items.map((item) => (
                  <div class="group relative mb-10">
                    <div class="relative w-full bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                      <img
                        src={item.image}
                        alt="..."
                        class="w-full h-full object-center object-cover"
                      ></img>
                    </div>
                    <h3 class="mt-5 text-center text-lg font-semibold text-gray-900">
                      {item.name}
                    </h3>

                    <h3 class="text-center text-base text-gray-500">
                      <a href={`/carousel?category=${item.name}`}>
                        <span class="absolute inset-0"></span>
                        {`${item.items_left} items in stock`}
                      </a>
                    </h3>
                  </div>
                ))
              //  :
              // (
              //   <div>There are no items in the pre order</div>
              // )
            }
          </div>
          {/* Pre Order Page Refresh */}
          {/** ====================================================================================================================== */}
          <div class="mt-6 space-y-12 lg:space-y-0 lg:grid lg:grid-cols-3 lg:gap-x-6">
            {
              batchItem.length > 0 &&
                batchItem.map((data) => (
                  <div class="group relative mb-10">
                    <div class="relative w-full bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                      <img
                        src={data.main_images_path}
                        alt="..."
                        class="w-full h-full object-center object-cover"
                      ></img>
                    </div>
                    <h3 class="mt-5 text-center text-lg font-semibold text-gray-900">
                      {data.item_category}
                    </h3>

                    <h3 class="text-center text-base text-gray-500">
                      <a href={`/carousel?category=${data.item_category}`}>
                        <span class="absolute inset-0"></span>
                        {`${data.quantity} items in stock`}
                      </a>
                    </h3>
                  </div>
                ))
              // :
              // (
              //   <div>There are no items in the pre order</div>
              // )
            }
          </div>
          {/* End of Pre Order */}
        </div>
      </div>
    </main>
    </>
  );
}
