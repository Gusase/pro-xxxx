// function process(location) {
//   let placeholder = processTxt(location);
//   let preprocessElement;
//   const loader = `
//   <button type="submit" class="inline-flex w-full justify-center px-4 py-2.5 bg-gray-600 border border-gray-300 rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 disabled:opacity-75 transition ease-in-out duration-150 cursor-not-allowed" disabled="">
//     <svg class="motion-safe:animate-spin -ml-1 mr-1.5 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
//       <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
//       <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
//     </svg>
//     ${placeholder}
//   </button>
//   `;

//   if (location == "logout") {
//     document.getElementById("formLogout").submit();

//     preprocessElement = document.getElementById("preprocessOut");

//     preprocessElement.innerHTML = loader;
//   } else if (location == "delete") {
//     document.getElementById("formDelete").submit();

//     preprocessElement = document.getElementById("preprocessDel");

//     preprocessElement.innerHTML = loader;
//   } else if (location == "deleteUser") {
//     document.getElementById("dxz").submit();

//     preprocessElement = document.getElementById("preprocessDel");

//     preprocessElement.innerHTML = loader;
//   } else if (location == "send") {
//     document.getElementById("formShareFile").submit();

//     preprocessElement = document.getElementById("preprocess");

//     preprocessElement.innerHTML = loader;
//   } else {
//     document.getElementById("form").submit();

//     preprocessElement = document.getElementById("preprocess");

//     preprocessElement.innerHTML = loader;
//   }
// }

// function processTxt(placeholder) {
//   switch (placeholder) {
//     case "login":
//       return "Logging in...";
//     case "register":
//       return "Registering...";
//     case "logout":
//       return "Logging out...";
//     // …
//     case "send":
//       return "Sending...";
//     case "add":
//       return "Adding...";
//     case "save":
//       return "Saving...";
//     case "delete":
//       return "Deleting...";
//     case "verify":
//       return "Verifying...";
//     case "deleteUser":
//       return "Deleting...";
//     default:
//       return "Processing...";
//   }
// }
