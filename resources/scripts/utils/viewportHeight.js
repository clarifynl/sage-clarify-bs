const viewportHeight = () => {
	const doc = document.documentElement;

	doc.style.setProperty('--viewport-height', `${window.innerHeight}px`);
};

window.addEventListener('resize', viewportHeight);
viewportHeight();