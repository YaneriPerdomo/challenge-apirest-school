import { barLinks, url } from "../variables.js";

function header() {
    if (url.href.includes("/asignaturas") || url.href.includes("/asignatura/")) {
        barLinks[3].classList.add("item-selected");
    }
    if (url.href.includes("/alumnos") || url.href.includes("/alumno/") || url.href.includes("/alumna")) {
        barLinks[1].classList.add("item-selected");
    }
    if (url.href.includes("/profesores") || url.href.includes("/profesor/") || url.href.includes("/profesora")) {
        barLinks[2].classList.add("item-selected");
    }
    if (url.href.includes("/inicio")  ) {
        barLinks[0].classList.add("item-selected");
    }
}

header();
