import { ItemButttonSearh, ItemInputName } from "../variables.js";
import { locationHrefSearch } from "./locationHrefSearch.JS";

 
ItemButttonSearh.addEventListener("click", async (e) => {
    let ItemInputNameSlug = ItemInputName.value;
    return locationHrefSearch(
        {
            urlData:
                ItemInputName.getAttribute("data-url") +
                "/" +
                ItemInputNameSlug.trim() +
                "/buscar",
            urlRelative: ItemInputName.getAttribute("data-url"),
        },
        ItemInputName.value
    );
});
