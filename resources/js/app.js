import "./bootstrap";
import "flowbite";
import "../css/app.css";

// Bootstrap
import "bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";

// Popper.js
import * as Popper from "@popperjs/core";
window.Popper = Popper;


// Flowbite
import "flowbite/dist/flowbite.min.js";

// DataTables
import DataTable from "datatables.net-dt";
import "datatables.net-responsive-dt";
import "datatables.net-autofill-bs5";
import "datatables.net-buttons-bs5";
import "datatables.net-buttons/js/buttons.colVis.mjs";
import "datatables.net-buttons/js/buttons.html5.mjs";
import "datatables.net-buttons/js/buttons.print.mjs";
import "datatables.net-colreorder-bs5";
import DateTime from "datatables.net-datetime";
import "datatables.net-fixedcolumns-bs5";
import "datatables.net-fixedheader-bs5";
import "datatables.net-keytable-bs5";
import "datatables.net-responsive-bs5";
import "datatables.net-rowgroup-bs5";
import "datatables.net-rowreorder-bs5";
import "datatables.net-scroller-bs5";
import "datatables.net-searchbuilder-bs5";
import "datatables.net-searchpanes-bs5";
import "datatables.net-select-bs5";
import "datatables.net-staterestore-bs5";

// DataTables CSS
import "datatables.net-bs5/css/dataTables.bootstrap5.min.css";
import "datatables.net-autofill-bs5/css/autoFill.bootstrap5.min.css";
import "datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css";
import "datatables.net-colreorder-bs5/css/colReorder.bootstrap5.min.css";
import "datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css";
import "datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css";
import "datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css";
import "datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css";
import "datatables.net-rowgroup-bs5/css/rowGroup.bootstrap5.min.css";
import "datatables.net-rowreorder-bs5/css/rowReorder.bootstrap5.min.css";
import "datatables.net-scroller-bs5/css/scroller.bootstrap5.min.css";
import "datatables.net-searchbuilder-bs5/css/searchBuilder.bootstrap5.min.css";
import "datatables.net-searchpanes-bs5/css/searchPanes.bootstrap5.min.css";
import "datatables.net-select-bs5/css/select.bootstrap5.min.css";
import "datatables.net-staterestore-bs5/css/stateRestore.bootstrap5.min.css";

// Additional required libraries
import jszip from "jszip";
import pdfmake from "pdfmake";

// Styles
import "normalize.css/normalize.css";
import "@fortawesome/fontawesome-free/css/all.min.css";

// Make DataTable globally available
window.DataTable = DataTable;



// Echo.channel("event-channel").listen("YourEventName", (e) => {
//     console.log(e.message);
// });