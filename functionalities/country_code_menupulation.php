<!-- ========================== data manupulating=============================  -->
<?php
// include "./config/db_connection.php";
$sql = "SELECT name AS country_name, id  AS country_id, phonecode, nicename FROM country;";
// $sql = "select * from country";
if (db_connection()->query($sql)) {
    $country_data_collection = db_connection()->query($sql);
    // $country_data_collection = mysqli_fetch_all($country_data_collection_raw, MYSQLI_ASSOC);
} else {
    echo "Technical error please email us for your about the problem.";
}
?>

<script type="text/javascript">
    // css element selection 
    let country = document.querySelector("#country");
    let phoneCode = document.querySelector('#phone-code');

    // collection of data 
    let country_data_collection = <?= json_encode(mysqli_fetch_all($country_data_collection, MYSQLI_ASSOC)) ?>;

    // creating html element 
    for (let value of country_data_collection) {

        let newElement;
        // country data 
        newElement = document.createElement('option');
        newElement.textContent = value.country_name;
        newElement.setAttribute("value", value.country_id);
        country.append(newElement);


        // phone code 
        newElement = document.createElement('option');
        newElement.textContent = value.phonecode;
        newElement.setAttribute("value", value.country_id);
        phoneCode.append(newElement);
    }

    // elements attributes 
    country.firstElementChild.setAttribute('selected', '');
    phoneCode.firstElementChild.setAttribute('selected', '');


    //Auto select event =====================================
    country.addEventListener("change", (e) => {
        let selectedCountry = e.target.value;
        phoneCode.firstElementChild.removeAttribute("selected");

        let count = 1;
        for (value in country_data_collection) {
            let newNode;
            newNode = document.createTextNode(country_data_collection[value].phonecode);

            //   replace node
            let existedElement = phoneCode.children[count];
            existedElement.replaceChild(newNode, existedElement.childNodes[0]);

            //   attributes
            existedElement.removeAttribute("selected");
            if (country_data_collection[value].country_id == selectedCountry) {
                existedElement.setAttribute("selected", "");
                console.log(country_data_collection[value].country_id);
            }
            count++;
        }
    });
</script>