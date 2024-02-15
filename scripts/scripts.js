function showProductTypeFields() {
    var productType = document.getElementById("productType").value;
    document.getElementById("selectedProductType").value = productType;
    document.getElementById("sizeField").style.display = "none";
    document.getElementById("weightField").style.display = "none";
    document.getElementById("dimensionsField").style.display = "none";

    if (productType === "dvd") {
        document.getElementById("sizeField").style.display = "block";
    } else if (productType === "book") {
        document.getElementById("weightField").style.display = "block";
    } else if (productType === "furniture") {
        document.getElementById("dimensionsField").style.display = "block";
    }
}

var enteredSKUs = [];

function validateForm() {
    var productType = document.getElementById("productType").value;
    var sku = document.getElementById("sku").value;

    if (!productType) {
        alert("Please select a Product Type.");
        return false;
    } else if (!sku) {
        alert("Please enter SKU.");
        return false;
    } else if (productType === "dvd" && !document.getElementById("size").value) {
        alert("Please enter Size (MB) for DVD.");
        return false;
    } else if (productType === "book" && !document.getElementById("weight").value) {
        alert("Please enter Weight (Kg) for Book.");
        return false;
    } else if (productType === "furniture") {
        if (!document.getElementById("height").value || !document.getElementById("width").value || !document.getElementById("length").value) {
            alert("Please enter all dimensions for Furniture.");
            return false;
        }
    }

    enteredSKUs.push(sku);
    return true;
}


function massDelete() {
    console.log("Mass Delete button clicked");

    var checkboxes = document.querySelectorAll('input[name="deleteIds[]"]:checked');

    var selectedIds = Array.from(checkboxes).map(function (checkbox) {
        return checkbox.value;
    });

    console.log("Selected Product IDs:", selectedIds);

    document.getElementById('deleteIds').value = selectedIds.join(',');

    console.log("Submitting mass delete form...");
    document.getElementById('massDeleteForm').submit();
}