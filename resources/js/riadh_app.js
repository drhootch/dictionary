export default () => ({
    async init() {
        window.riadh_app = this;
        if (chrome?.runtime) {
            const elements = document.querySelectorAll('#riadh_app [src]');

            for (const elem of elements) {
                elem.src = chrome.runtime.getURL(`${elem.getAttribute("src")}`);
            }
        }
        // this.fetchMeaning()
    },
    info: {},
    get show() {
        return window.riadh_app.info.word;
    },
    showOtherMeanings: false,
    showClosestDetails: false,
    showSuggestedDetails: false,
    loading: false,
    answer: null,
    get isGoodAnswer() {
        return window.riadh_app.answer?.ai?.analysis?.[0].meaningNumber && (window.riadh_app.answer?.ai?.analysis?.[0].percentage >= 50 || !window.riadh_app.answer?.ai?.analysis?.[0].percentage)
    },
    fetchMeaning: () => {
        window.riadh_app.showOtherMeanings = false
        window.riadh_app.showClosestDetails = false
        window.riadh_app.showSuggestedDetails = false
        window.riadh_app.answer = null
        window.riadh_app.loading = true
        console.log('window.riadh_app.info:', window.riadh_app.info)

        //cancel fetch when new word is selected
        fetch('https://mo3jam-extension.gammacodes.com/api/entry/process', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                // extra: 1,
                word: window.riadh_app.info.word,
                context: window.riadh_app.info.context
            }),
        })
            .then(response => response.json())
            .then(data => {
                window.riadh_app.loading = false
                if(data?.ai?.analysis?.length) {
                    data.ai.analysis.sort((a, b) => b.percentage - a.percentage)
                }
                window.riadh_app.answer =  data
                console.log('Success:', window.riadh_app.answer)
            });
    },
})
