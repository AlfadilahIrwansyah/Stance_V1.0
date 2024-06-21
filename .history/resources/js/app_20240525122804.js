import 'bootstrap';
import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

function DarkMode()
{
    var bodyArray;

    bodyArray = document.getElementsByClassName("body-home-light");

    for(var i = 0; i < elementArray.length; i++)
    {
        // PERFORM STUFF ON THE ELEMENT
        elementArray[i].setAttribute("class", "exampleClassComplete");
        alert(elementArray[i].className);
    }
}
