import '../css/home.scss';

const tabSelects = document.querySelectorAll('.tab-select');

tabSelects.forEach(b => {
    b.addEventListener('click', (e) => {
        let btn = e.target;

        let currentBtn = btn.closest('.tab-selector').querySelector('.tab-select.current');
        currentBtn.classList.remove('current');
        btn.classList.add('current');

        let relatedTabsContainer = document.querySelector(btn.dataset.tabContainer);
        console.log(btn.dataset.tabContainer);
        console.log(relatedTabsContainer);
        let currentTab = relatedTabsContainer.querySelector('.tab.current');

        currentTab.classList.remove('current');
        relatedTabsContainer.querySelector(btn.dataset.tab).classList.add('current');
    });
});