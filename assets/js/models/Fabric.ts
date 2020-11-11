import Color from './Color';

export default class Fabric {
  '@context': string = '';

  '@id': string = '';

  '@type': string = '';

  id: number = 0;

  box: number = 0;

  material: string = '';

  pattern: string = '';

  state: string = '';

  thickness: string = '';

  width: number = 0;

  length: number = 0;

  comment: string = '';

  colors: Color[] = [];
}
