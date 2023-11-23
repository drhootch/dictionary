export default () => ({
    async init() {
        window.riadh_app = this;
        if (chrome?.runtime) {
            const elements = document.querySelectorAll('#riadh_app [src]');

            for (const elem of elements) {
                elem.src = chrome.runtime.getURL(`${elem.getAttribute("src")}`);
            }
        }
    },
    info: {},
    get show() {
        return window.riadh_app.info.word;
    },
    showOtherMeanings: false,
    showClosestDetails: false,
    showSuggestedDetails: false,
    loading: false,
    secondRequestLoading: false,
    answer: null,
    currentContext: null,
    get isGoodAnswer() {
        return window.riadh_app.answer?.ai?.analysis?.[0].meaningNumber && (parseInt(window.riadh_app.answer?.ai?.analysis?.[0].percentage) >= 50 || !window.riadh_app.answer?.ai?.analysis?.[0].percentage)
    },
    fetchMeaning: () => {
        if (window.riadh_app.currentContext === window.riadh_app.info.context) {
            return
        }
        window.riadh_app.showOtherMeanings = false
        window.riadh_app.showClosestDetails = false
        window.riadh_app.showSuggestedDetails = false
        window.riadh_app.answer = null
        window.riadh_app.loading = true
        window.riadh_app.currentContext = window.riadh_app.info.context

        fetch('http://mo3jam.test/api/entry/process', {
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
                if (window.riadh_app.currentContext !== data.context) {
                    return
                }
                if (data?.ai?.analysis?.length) {
                    data.ai.analysis.sort((a, b) => parseInt(b.percentage) - parseInt(a.percentage))
                }
                window.riadh_app.answer = data
            });

        window.riadh_app.secondRequestLoading = true
        fetch('http://mo3jam.test/api/entry/process', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                extra: 1,
                word: window.riadh_app.info.word,
                context: window.riadh_app.info.context
            }),
        })
            .then(response => response.json())
            .then(data => {
                window.riadh_app.loading = false
                window.riadh_app.secondRequestLoading = false
                if (window.riadh_app.currentContext !== data.context || (window.riadh_app.currentContext == data.context && window.riadh_app.answer?.extra)) {
                    return
                }
                if (data?.ai?.analysis?.length) {
                    data.ai.analysis.sort((a, b) => parseInt(b.percentage) - parseInt(a.percentage))
                }
                window.riadh_app.answer = data
            });
    },
})
