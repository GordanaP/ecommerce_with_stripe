<tr>
    <td colspan="4" class="text-right">
        <p class="font-bold mb-2">Subtotal:</p>
        <p class="mb-2">Shipping & Handling:</p>
        <p class="mb-2">Tax ({{ ShoppingCart::fromSession()->presentTaxRate() }}):</p>
        <p class="mb-0 uppercase font-bold">Grand Total:</p>
    </td>

    <td class="text-right">
        <p class="font-bold mb-2">
            {{ ShoppingCart::fromSession()->presentSubtotal() }}
        </p>
        <p class="mb-2">
            {{ ShoppingCart::fromSession()->presentShippingCosts() }}
        </p>
        <p class="mb-2">
            {{ ShoppingCart::fromSession()->presentTaxAmount() }}
        </p>
        <p class="font-bold mb-1">
            {{ ShoppingCart::fromSession()->presentTotal() }}
        </p>
    </td>
    <td></td>
</tr>