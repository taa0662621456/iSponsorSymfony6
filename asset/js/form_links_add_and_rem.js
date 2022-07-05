const prototypeHolder = document.getElementById('project_stepThree_projectAttachments')
const collectionPlace = prototypeHolder

const addFormToCollection = (e) => {
    const prototypeHolder = document.querySelector('.' + e.target.dataset.collectionHolderClass);

    const item = document.createElement('div');

    item.classList.add('item')

    const items = document.querySelectorAll('div.item')
    items.forEach((tag) => {
        addTagFormDeleteLink(tag)
    })

    item.innerHTML = prototypeHolder
        .dataset
        .prototype
        .replace(
            /__name__/g,
            prototypeHolder
                .dataset
                .index
        );

    collectionPlace.appendChild(item);

    prototypeHolder
        .dataset
        .index++;
}

const items = document.querySelectorAll('div.item')
items.forEach((tag) => {
    addTagFormDeleteLink(tag)
})

const remFormCollection = (item) => {
    const removeButton = document.querySelectorAll('.rem_item_link')

    const items = document.querySelectorAll('div.item')
    items.forEach((tag) => {
        addTagFormDeleteLink(tag)
    })

    removeButton.addEventListener('click', (e) => {
        e.preventDefault()

        items.remove()
    })
}


document.
querySelectorAll('.add_item_link')
    .forEach(btn => btn.addEventListener("click", addFormToCollection))

document.
querySelectorAll('.rem_item_link')
    .forEach(btn => btn.addEventListener("click", remFormCollection))
