import Color from './Color';

export default class Fabric {
    '@context'?: string;
    '@id'?: string;
    '@type'?: string;
    id: number;
    box: number;
    material: string;
    pattern: string;
    state: string;
    thickness: string;
    width?: number;
    length?: number;
    comment?: string;
    colors: Color[];

    constructor(
        id: number = 0,
        box: number = 0,
        material: string = '',
        pattern: string = '',
        state: string = '',
        thickness: string = '',
        colors: Color[] = []
    ) {
        this.id = id;
        this.box = box;
        this.material = material;
        this.pattern = pattern;
        this.state = state;
        this.thickness = thickness;
        this.colors = colors;
    }
}
