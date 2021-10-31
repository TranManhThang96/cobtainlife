// localStorage
var localStorageDB = function () {
  this.key = this.key || 'unknown';
  this.value = this.value || {};
}
// insert into localStorage
localStorageDB.prototype.set = function (key, value) {
  if (this.checkifSupport()) {
    try {
      this.key = key;
      this.value = value;
      window.localStorage.setItem(this.key, this.value);
    } catch (e) {
      throw new TypeError('Exceeded Storage Quota!');
      return true;
    }
  } else {
    throw new TypeError("No support. Use a fallback such as browser cookies or store on the server.");
    return false;
  }
}
localStorageDB.prototype.get = function (key) {
  try {
    this.key = key;
    var data = window.localStorage.getItem(this.key);
    if (data && typeof (data) === 'object') {
      return JSON.parse(data);
    } else {
      return data;
    }
  } catch (e) {
    return null;
  }
}
localStorageDB.prototype.getAll = function () {
  var array = new Array();
  for (var i = 0; i < window.localStorage.length; i++) {
    var key = localStorage.key(i);
    array.push(this.get(key));
  };
  return array;
}
localStorageDB.prototype.remove = function (key) {
  this.key = key;
  try {
    window.localStorage.removeItem(this.key);
    if (window.localStorage.length == 0) {
      this.clearAll();
    }
    return true;
  } catch (e) {
    return false;
  } finally {
    if (this.get(this.key)) {
      delete window.localStorage[this.key];
      if (window.localStorage.length == 0) {
        this.clearAll();
      }
    }
  }
}
localStorageDB.prototype.clearAll = function () {
  try {
    window.localStorage.clear();
    return true;
  } catch (e) {
    return false;
  }
}
localStorageDB.prototype.checkifSupport = function () {
  try {
    return "localStorage" in window && window["localStorage"] !== null;
  } catch (e) {
    return false;
  }
}

export default localStorageDB;
