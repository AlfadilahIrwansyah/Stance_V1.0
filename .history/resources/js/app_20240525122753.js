import 'bootstrap';
import.meta.glob([
  '../images/**',
  '../fonts/**',
]);

function DarkMode()
{
    var bodyArray;

    elementArray = document.getElementsByClassName("exampleClass");

    for(var i = 0; i < elementArray.length; i++)
    {
        // PERFORM STUFF ON THE ELEMENT
        elementArray[i].setAttribute("class", "exampleClassComplete");
        alert(elementArray[i].className);
    }
}
