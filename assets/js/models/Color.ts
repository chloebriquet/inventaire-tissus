export default class Color {
    '@context'?: string;
    '@id'?: string;
    '@type'?: string;
    id: number;
    name: string;
    code: string;

    constructor(
        id: number = 0,
        name: string = '',
        code: string = ''
    ) {
        this.id = id;
        this.name = name;
        this.code = code;
    }
}