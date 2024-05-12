const bannerWrapper = document.querySelector(".bannerCarousel");
bannerWrapper.innerHTML+=bannerWrapper.getElementsByTagName("img")[0].outerHTML;
let counter = 1;
let limit = (bannerWrapper.getElementsByTagName("img").length)-1;
if(limit > 1) setInterval((async () => {
  if(counter==limit)
  {
    bannerWrapper.style.transform = "translateX(-"+(counter * 100)+"vw)";
    await wait(500);
    bannerWrapper.style.transitionDuration="0ms";
    bannerWrapper.style.transform="translateX(0vw)";
    await wait(50);
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