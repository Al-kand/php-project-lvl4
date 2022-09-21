import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

import Ujs from "@rails/ujs";
window.Ujs = Ujs;
// // const ujs = require("@rails/ujs");
// // window.ujs = ujs;
Ujs.start();
