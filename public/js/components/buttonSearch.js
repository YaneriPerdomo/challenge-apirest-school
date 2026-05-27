import { ItemButttonSearh, ItemInputName } from "../variables.js";
import { locationHrefSearch } from "./locationHrefSearch.JS";

function slugify(text) {
  console.info(text);
    const lowercase = text.toLowerCase();
    const slug = lowercase.replace(/[^a-z0-9]+/g, "-");
    const trimmedSlug = slug.replace(/^-+|-+$/g, "");
    return trimmedSlug;
}
ItemButttonSearh.addEventListener("click", async (e) => {
    let ItemInputNameSlug = slugify(ItemInputName.value);
    return locationHrefSearch(
        {
            urlData:
                ItemInputName.getAttribute("data-url") +
                "/" +
                ItemInputNameSlug.trim() +
                "U["+ ItemInputName.value +"]/filtrar",
            urlRelative: ItemInputName.getAttribute("data-url"),
        },
        ItemInputName.value
    );
});
