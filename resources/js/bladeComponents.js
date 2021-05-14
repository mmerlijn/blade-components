/*
* Flash message
* */
window.flashesHandler = function() {
    return {
        flashes: [],
        visible: [],
        add(flash) {
            flash.id = Date.now()
            this.flashes.push(flash)
            this.fire(flash.id)
        },
        fire(id) {
            this.visible.push(this.flashes.find(flash => flash.id == id))
            const timeShown = 4000 * this.visible.length
            setTimeout(() => {
                this.remove(id)
            }, timeShown)
        },
        remove(id) {
            const flash = this.visible.find(flash => flash.id == id)
            const index = this.visible.indexOf(flash)
            this.visible.splice(index, 1)
        },
        getIcon(flash) {
            if (flash.type == 'success')
                return "<div class='text-green-500 rounded-full bg-white float-left' ><svg width='1.8em' height='1.8em' viewBox='0 0 16 16' class='bi bi-check' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z'/></svg></div>";
            else if (flash.type == 'notice')
                return "<div class='text-blue-500 rounded-full bg-white float-left'><svg width='1.8em' height='1.8em' viewBox='0 0 16 16' class='bi bi-info' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path d='M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z'/><circle cx='8' cy='4.5' r='1'/></svg></div>";
            else if (flash.type == 'warning')
                return "<div class='text-orange-500 rounded-full bg-white float-left'><svg width='1.8em' height='1.8em' viewBox='0 0 16 16' class='bi bi-exclamation' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path d='M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z'/></svg></div>";
            else if (flash.type == 'danger')
                return "<div class='text-red-500 rounded-full bg-white float-left'><svg width='1.8em' height='1.8em' viewBox='0 0 16 16' class='bi bi-x' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z'/><path fill-rule='evenodd' d='M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z'/></svg></div>";
        }
    };
}

window.flashSuccess = message => window.dispatchEvent(new CustomEvent('toast',{detail: {type: 'success', text: message}}));
window.flashInfo = message => window.dispatchEvent(new CustomEvent('toast',{detail: {type: 'info', text: message}}));
window.flashNotice = message => window.dispatchEvent(new CustomEvent('toast',{detail: {type: 'info', text: message}}));
window.flashWarning = message => window.dispatchEvent(new CustomEvent('toast',{detail: {type: 'warning', text: message}}));
window.flashDanger = message => window.dispatchEvent(new CustomEvent('toast',{detail: {type: 'danger', text: message}}));

/*
* Tag input
* Based on
* https://github.com/danharrin/alpine-tailwind-components
* */

window.tagInputHandler = function(config) {
    return {
        data: config.data,

        emptyOptionsMessage: config.emptyOptionsMessage ?? 'No results match your search.',

        focusedOptionIndex: null,

        name: config.name,

        open: false,

        options: [],

        placeholder: config.placeholder ?? 'Select an option',

        search: '',

        value: config.value,

        selected: config.value.split(','), //[], //selected items

        k: config.key??'l',
        l: config.label??'l',
        d: config.display ??'d',

        closeListbox: function () {
            this.open = false

            this.focusedOptionIndex = null

            this.search = ''
        },

        focusNextOption: function () {
            if (this.focusedOptionIndex === null) return this.focusedOptionIndex = 0

            if (this.focusedOptionIndex + 1 >= Object.keys(this.options).length) return

            this.focusedOptionIndex++

            this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                block: "center",
            })
        },

        focusPreviousOption: function () {
            if (this.focusedOptionIndex === null) return this.focusedOptionIndex = Object.keys(this.options).length - 1

            if (this.focusedOptionIndex <= 0) return

            this.focusedOptionIndex--

            this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                block: "center",
            })
        },

        init: function () {
            this.options = this.data

            this.restoreOptions()

            // filter selected items for existence in options
            this.selected = this.data.reduce((result=[],dataItem)=>{
                if(this.selected.includes(dataItem[this.k])){
                    result.push(dataItem[this.k])
                }
                return result
            },[])

            this.$watch('search', ((value) => {
                if (!this.open || !value) return this.restoreOptions()

                this.options = this.data
                    .reduce((result=[],dataItem) => {
                        if(!this.selected.includes(dataItem[this.k]) && dataItem[this.d].toLowerCase().includes(value.toLowerCase())){
                            result.push(dataItem)
                        }
                        return result
                    }, [])

            }))

        },

        selectOption: function () {
            if (!this.open) return this.toggleListboxVisibility()
            this.selected.push(this.options[this.focusedOptionIndex][this.k])
            this.restoreOptions()
            this.closeListbox()
        },
        removeItem: function(index){
            if(this.open) this.closeListbox()
            this.selected.splice(index,1)
            this.restoreOptions()
        },
        restoreOptions: function(){
            this.options = this.data.reduce((result=[],dataItem)=>{
                if(!this.selected.includes(dataItem[this.k])){
                    result.push(dataItem)
                }
                return result
            },[])

        },
        toggleListboxVisibility: function () {
            if (this.open) return this.closeListbox()

            if (this.focusedOptionIndex < 0) this.focusedOptionIndex = 0

            this.open = true

            this.$nextTick(() => {
                this.$refs.search.focus()
                this.$refs.listbox.children[this.focusedOptionIndex+1].scrollIntoView({
                    block: "nearest"
                })
            })
        },
    }
}

/*
* Autocomplete
* Credit to https://github.com/danharrin/alpine-tailwind-components
* */
window.autocompleteHandler =     function(config) {
    return {
        data: config.data,

        emptyOptionsMessage: config.emptyOptionsMessage ?? 'No results found.',

        focusedOptionIndex: null,

        name: config.name,

        open: false,

        options: [],

        placeholder: config.placeholder ?? 'Select an option',

        search: '',

        value: config.value,
        show: {},
        k: config.key??'k',
        d: config.display ??'d',

        closeListbox: function () {
            this.open = false

            this.focusedOptionIndex = null

            this.search = ''
        },

        focusNextOption: function () {
            if (this.focusedOptionIndex === null) return this.focusedOptionIndex = 0

            if (this.focusedOptionIndex + 1 >= Object.keys(this.options).length) return

            this.focusedOptionIndex++

            this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                block: "center",
            })
        },

        focusPreviousOption: function () {
            if (this.focusedOptionIndex === null) return this.focusedOptionIndex = Object.keys(this.options).length - 1

            if (this.focusedOptionIndex <= 0) return

            this.focusedOptionIndex--

            this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                block: "center",
            })
        },

        init: function () {
            this.options = this.data

            if(this.value) {
                if (!this.data.some(item => item[this.k] === this.value)) {
                    this.value = '';
                } else {
                    this.show = this.data.find(item => item.k === this.value)
                }
            }
            this.$watch('search', ((value) => {
                if (!this.open || !value) return this.options = this.data

                this.options = this.data
                    .reduce((result=[],dataItem) => {
                        if(dataItem[this.d].toLowerCase().includes(value.toLowerCase())){
                            result.push(dataItem)
                        }
                        return result
                    }, [])
            }))
        },

        selectOption: function () {
            if (!this.open) return this.toggleListboxVisibility()

            this.value = this.options[this.focusedOptionIndex][this.k]
            this.show = this.options[this.focusedOptionIndex];
            this.closeListbox()
        },

        toggleListboxVisibility: function () {
            if (this.open) return this.closeListbox()

            this.focusedOptionIndex = Object.keys(this.options).indexOf(this.value)

            if (this.focusedOptionIndex < 0) this.focusedOptionIndex = 0

            this.open = true

            this.$nextTick(() => {
                this.$refs.search.focus()

                this.$refs.listbox.children[this.focusedOptionIndex+1].scrollIntoView({
                    block: "nearest"
                })
            })
        },
    }
}
