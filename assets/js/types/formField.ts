export default class FormField {
    field: string;
    error: string;

    constructor(
        field: string = '',
        error: string = '',
    ) {
        this.field = field;
        this.error = error;
    }

    resetError(): void {
        this.error = '';
    }
}
