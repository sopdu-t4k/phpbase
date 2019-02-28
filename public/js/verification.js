"use strict";

function Form(name, fields) {
    this.name = name;
    this.fields = fields;
    this.element = document.querySelector(`[name="${this.name}"]`); 
};

Form.prototype.init = function() {
    this.element.addEventListener('submit', e => this.formSubmit(e)); 
};

Form.prototype.formSubmit = function(e) {
    if(!this.validate()) {
        e.preventDefault();
        this.feedback(); 
    }   
};

Form.prototype.validate = function() {
    var valid = true;
    this.fields.forEach(function(field) {
        if (field instanceof FieldForm) {
            if (!field.validate()) {    
                valid = false;
            }
        }
    });
    return valid;
};

Form.prototype.feedback = function() {
    this.fields.forEach(function(field) {
        if (field instanceof FieldForm) {
            field.feedback();
        } 
    });
};

function FieldForm(name, pattern, message, required) {
    this.name = name;
    this.regexp = pattern;
    this.message = message;
    this.required = required;
    this.element = document.querySelector(`[name="${this.name}"]`);
};

FieldForm.prototype.validate = function() {
    var valid = true;
    var value = this.element.value.trim();
    if (value != '') {
        valid = this.regexp.test(value);
    } else {
        valid = !this.required;
    }
    return valid;
};

FieldForm.prototype.feedback = function() {
    var helptext = this.element.value.trim() != '' ? this.message : 'Заполните это поле';
    if (this.element.classList.contains('is-invalid')) {
        this.element.classList.remove('is-invalid');
        this.element.parentElement.removeChild(this.element.parentElement.lastChild);
    }
    if (!this.validate()) {
        this.element.classList.add('is-invalid');
        var message = document.createElement('div');
        message.className = 'invalid-feedback';
        message.textContent = helptext; 
        this.element.parentElement.appendChild(message);
    }
};

if (document.querySelector('[name=product]')) {
    var productForm = new Form('product', [
        new FieldForm('name', /^.+/, '', true),
        new FieldForm('price', /^\d+\.?\d?\d?$/, 'Поле может содержать только цифры и точку', true),
        new FieldForm('discount', /^([0-9][0-9]?|100)$/, 'Введите число от 0 до 100', true),
        new FieldForm('image', /[^\s]+\.(?:jpg|JPG|jpeg|png)$/, 'Выберите файл с расширением .jpg или .png', false),
    ]);
    productForm.init();
}

if (document.querySelector('[name=order]')) {
    var orderForm = new Form('order', [
        new FieldForm('name', /^[A-Za-zА-Яа-яЁё\s]+$/, 'Поле может содержать буквы и пробелы', true),
        new FieldForm('phone', /^\8\(\d{3}\)\d{7}$/, 'Укажите номер телефона в формате 8(000)0000000', true),
    ]);
    orderForm.init();
}
