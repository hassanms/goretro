import React from "react";
import { useEffect } from "react";
import { useState } from "react";

const Statusbar = (props) => {
  return (
    <nav class="bg-blue-200">
      <div class="max-w-5xl mx-90 px-2 sm:px-6 lg:px-6">
        <div class="relative flex items-center justify-between h-10">
          {props.subTotal ? (
            <>
              <span>{`Spend £${1000 - props.subTotal} to get a pick of super rare item`}</span>
              <div className="w-3/5 bg-gray-200 rounded-full dark:bg-white">
                <div
                  className="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                  style={{ width: `${String(props.subTotal).slice(0, 2)}` }}
                >
                  {" "}
                  {`${String(props.subTotal).slice(0, 2)}%`}
                </div>
              </div>
            </>
          ) : (
            "Signup to our Restock mailingList"
          )}
        </div>
      </div>
    </nav>
  );
};

export default Statusbar;
