import { TestBed } from '@angular/core/testing';

import { BddCreateService } from './bdd-create.service';

describe('BddCreateService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: BddCreateService = TestBed.get(BddCreateService);
    expect(service).toBeTruthy();
  });
});
