class farallonDate {
    selector: string;
    doms: Array<any> = [];
    constructor(config: any) {
        this.selector = config.selector;
        this.init();
        setTimeout(() => {
            this.refresh();
        }, 1000 * 5);
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
            return `${Math.ceil(between / 86400)} 天前`;
        } else if (between < 86400 * 30 * 12) {
            return `${Math.ceil(between / (86400 * 30))} 月前`;
        } else {
            return time.getFullYear() + '-' + (time.getMonth() + 1) + '-' + time.getDate();
        }
    }

    refresh() {
        this.doms.forEach((dom: any) => {
            dom.innerText = this.humanize_time_ago(dom.attributes['datetime'].value);
        });
    }
}

new farallonDate({
    selector: '.humane--time',
});
