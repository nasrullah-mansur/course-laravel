"use strict";

let allModuleCatBtn = document.querySelectorAll('.module-category button');


Array.from(allModuleCatBtn).forEach((element) => {
    let textClass = element.nextElementSibling;
    let buttonHeight = element.offsetHeight;
    let textClassHeight = textClass.offsetHeight;

    if (window.matchMedia('screen and (max-width: 768px)').matches) {
        buttonHeight += 30;
        textClassHeight += 30;
    }
  
    textClass.style.cssText = `top: ${buttonHeight}px`;
    let classUnderCategory = element.parentElement.querySelectorAll('.class-item').length;
    if(classUnderCategory >= 0 && classUnderCategory <= 9) {
        classUnderCategory = '0' + classUnderCategory;
    }

    element.parentElement.querySelector('small').innerHTML = classUnderCategory + ' Classes';

    element.addEventListener('click', () => {
        element.classList.add('active')
        
        if(element.classList.contains('open')) {
            element.classList.remove('open');
            textClass.classList.remove('open');
            element.parentElement.style.cssText = `padding-bottom: 0`;
        } else {
            element.classList.add('open');
            textClass.classList.add('open');
            element.parentElement.style.cssText = `padding-bottom: ${textClassHeight}px`;
        }

        
        
    })
})

let allClassItems = document.querySelectorAll('.class-item a');
Array.from(allClassItems).forEach((element, index) => {
    index = index + 1;
    if(index >= 0 && index <= 9) {
        index = '0' + index;
    }
    element.querySelector('a span').innerHTML = (index) + '. ';

    element.addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelector('.overlay').classList.add('show');
        document.querySelector('.popup').classList.add('show');
    })

    document.querySelector('.overlay').addEventListener('click', () => {
        removePopup()
    })

    document.querySelector('.popup .close').addEventListener('click', () => {
        removePopup()
    })
})

function removePopup() {
    document.querySelector('.overlay').classList.remove('show');
    document.querySelector('.popup').classList.remove('show');
    let popupLists = document.querySelector('.popup ul');
    popupLists.innerHTML = '';
}