export default class FormField {
    field: any;
    error: string;

    constructor(field: any = '', error: string = '') {
        this.field = field;
        this.error = error;
    }

    resetError(): void {
        this.error = '';
    }
    resetField(): void {
        this.field = '';
    }
}
