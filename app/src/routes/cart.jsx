import React, { useState, useEffect, useRef } from "react";
import axios from "axios";
import Timer from "../components/timer";
import { useSearchParams, useNavigate } from "react-router-dom";
import "tw-elements";
import Statusbar from "../components/Statusbar";

export default function Cart() {
  let cartObj = JSON.parse(localStorage.getItem("cart"));
  const total = cartObj.subTotal;
  console.log(total);
  cartObj = cartObj.cart;
  const [timer, setTimer] = useState("1:30");

  /**
   *  Countdown Timer Logic
   */

  /**
   *     End of Timer
   */

  const stripeCheckout = () => {
    const payload = {
      cartObj,
      total,
    };

    axios
      .post("http://127.0.0.1:8000/api/stripe-checkout", payload)
      .then((res) => {
        //Navigate to stripe checkout link
        window.location.replace(res.data[0]);
      })
      .catch((error) => {
        alert(error.message);
      });
  };

  //return HTML

  return (
    <>
      <Statusbar subTotal={total} />
      <main>
        <div>
          <div
            class="relative z-10"
            aria-labelledby="slide-over-title"
            role="dialog"
            aria-modal="true"
          >
            <div>
              <img
                class="w-4/5"
                src="https://images.pexels.com/photos/1666738/pexels-photo-1666738.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
              ></img>
            </div>
            <div class="fixed inset-0 overflow-hidden">
              <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                  <div class="pointer-events-auto w-screen max-w-md">
                    <div class="flex mt-28 h-full flex-col overflow-y-scroll bg-white shadow-xl">
                      <div class="flex-1 overflow-y-auto py-6 px-4 sm:px-6">
                        <div class="flex items-start justify-between">
                          <h2
                            class="text-lg font-medium text-gray-900"
                            id="slide-over-title"
                          >
                            Shopping cart
                          </h2>
                          <div class="ml-3 flex h-7 items-center"></div>
                        </div>

                        {/* //Start of Cart Object */}
                        {cartObj?.map((item, index) => (
                          <div class="mt-8" key={index}>
                            <div class="flow-root">
                              <ul
                                role="list"
                                class="-my-6 divide-y divide-gray-200"
                              >
                                <li class="flex py-6">
                                  <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                    <img
                                      src="https://icon-library.com/images/cloth-icon/cloth-icon-19.jpg"
                                      alt="Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt."
                                      class="h-full w-full object-cover object-center"
                                    ></img>
                                  </div>

                                  <div class="ml-4 flex flex-1 flex-col">
                                    <div>
                                      <div class="flex justify-between text-base font-medium text-gray-900">
                                        <h3>
                                          <a href="#"> {item.name} </a>
                                        </h3>
                                        <p class="ml-4">£{item.price}</p>
                                      </div>
                                      <p class="mt-1 text-sm text-gray-500">
                                        {item.category}
                                      </p>
                                    </div>
                                    <div class="flex flex-1 items-end justify-between text-sm">
                                      <p class="text-gray-500">{item.status}</p>

                                      <div class="flex">
                                        <a
                                          href="#"
                                          class="font-medium text-gray-300 hover:text-blue-900"
                                        >
                                          {item.tier}
                                        </a>
                                      </div>
                                    </div>
                                  </div>
                                </li>
                                {/* 
                    <!-- More products... --> */}
                              </ul>
                            </div>
                          </div>
                        ))}
                        <Timer />
                        {/* //End of Cart Object */}

                        <div class=" border-t border-gray-200 py-60 px-10 sm:px-6">
                          <div class="flex justify-between text-base font-medium text-gray-900">
                            <p class="text-green-900 font-bold text-xl">
                              Subtotal
                            </p>
                            <p class="text-green-900 font-bold text-base">
                              £{total}
                            </p>
                          </div>
                          <p class="mt-0.5 text-sm text-gray-500">
                            Shipping and taxes calculated at checkout.
                          </p>
                          <div class="mt-6">
                            <button
                              onClick={() => stripeCheckout()}
                              class="flex items-center justify-center rounded-md border border-transparent bg-gray-400 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-green-700"
                            >
                              Checkout
                            </button>
                          </div>
                          <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                            <p>
                              or{" "}
                              <a
                                href="./current-stock"
                                class="font-medium text-indigo-600 hover:text-indigo-500"
                              >
                                Continue Shopping
                                <span aria-hidden="true"> &rarr;</span>
                              </a>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </>
  );
}
