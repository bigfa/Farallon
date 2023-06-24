class farallonDate {
    selector: string;
    doms: Array<any> = [];
    constructor(config: any) {
        this.selector = config.selector;
        this.init();
    }

    init() {
        this.doms = Array.from(document.querySelectorAll(this.selector));
        this.doms.forEach((dom: any) => {
            dom.innerText = this.humanize_time_ago(dom.attributes['datetime'].value);
        });
    }

    humanize_time_ago(datetime: string) {
        const time = new Date(datetime);
        const between: number = Date.now() / 1000 - Number(time.getTime() / 1000);
        if (between < 3600) {
            return `${Math.ceil(between / 60)} 分钟前`;
        } else if (between < 86400) {
            return `${Math.ceil(between / 3600)} 小时前`;
        } else if (between < 86400 * 30) {
            return `${Math.ceil(between / (86400 * 24))} 天前`;
        } else {
            return `${Math.ceil(between / (86400 * 24 * 30))} 月前`;
        }
    }

    refresh() {}
}

new farallonDate({
    selector: 'time',
});
