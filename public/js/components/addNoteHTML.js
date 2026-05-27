async function addNoteHTML(label) {
    let text = "¡";
    let date = new Date();
    if (date.getHours() >= 0 && date.getHours() <= 12) {
        text = "Buenos dias,";
    }
    if (date.getHours() >= 12 && date.getHours() <= 18) {
        text = "Buenas tardes,";
    }
    if (date.getHours() >= 18 && date.getHours() <= 24) {
        text = "Buenas noches,  ";
    }
    return (label.innerHTML =
        "¡" + text + " usuario! El sistema web escolar está listo para trabajar.");
}
let formHeaderNote = document.querySelector(".note");
console.info(addNoteHTML(formHeaderNote));
