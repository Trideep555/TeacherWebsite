const bannerWrapper = document.querySelector(".bannerCarousel");
bannerWrapper.innerHTML+=bannerWrapper.getElementsByTagName("img")[0].outerHTML;
let counter = 1;
setInterval((async () => {
  if(counter==4)
  {
    bannerWrapper.style.transform = "translateX(-"+(counter * 100)+"vw)";
    await wait(500);
    bannerWrapper.style.transitionDuration="0ms";
    bannerWrapper.style.transform="translateX(0vw)";
    await wait(1);
    bannerWrapper.style.transitionDuration="500ms";
    counter=1;
  }
  else
  {
    bannerWrapper.style.transform = "translateX(-"+(counter * 100)+"vw)";
    counter++;
  }
}),3000)
const wait = (delay) => new Promise((resolve) => setTimeout(resolve, delay));